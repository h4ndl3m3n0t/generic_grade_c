<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\helpers\SortUtil;
use app\helpers\ArrayUtil;
use app\helpers\StringUtil;
use app\helpers\DataProviderUtil;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%semester}}".
 *
 * @property int $id
 * @property string $name
 * @property int $school_id
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property School $school
 * @property User $createdBy
 * @property Subject[] $subjects
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%semester}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'],'required'],
            [['school_id', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => School::class, 'targetAttribute' => ['school_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'school_id' => 'School ID',
            'created_by' => 'Created By',
            'created_at' => 'Created',
            'updated_at' => 'Modified',
        ];
    }

    /**
     * Gets query for [[School]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SchoolQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::class, ['id' => 'school_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SubjectQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['sem_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\SemesterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SemesterQuery(get_called_class());
    }

    /**
     * Finds the Semester model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id semester id
     * @param integer $school_id school id
     * @return Semester|array|null the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findSemester(int $id, int $school_id)
    {
        if (($model = static::find()
            ->andWhere([
                'id' => $id
            ])
            ->school($school_id)
            ->author(Yii::$app->user->id)
            ->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists all Semester models.
     * @param integer $school_id school id
     * @param integer $sort sort mode
     * @param bool $limit_mode add a limit of '10' per page (set 'true' by default)
     * @return mixed
     */
    public static function fetchSemesterData(int $school_id, int $sort, bool $limit_mode = true){
        $model = static::find()
            ->alias('sem')
            ->select(['sem.*,ROUND(AVG(gs.grade),2) as grade'])
            ->join('FULL OUTER JOIN',['subj' => Subject::tableName()],'subj.sem_id = sem.id')
            ->leftJoin(['gs' => GradeSystem::tableName()],'gs.id = subj.grade')
            ->leftJoin(['school' => School::tableName()],'school.id = subj.school_id')
            ->andWhere('sem.school_id=:school_id',[':school_id' => $school_id]) //school parameter
            ->andWhere('sem.created_by=:user',[':user' => Yii::$app->user->id]) //user parameter
            ->groupBy(['sem.id']); //group be semester id


        SortUtil::sort($sort, $model);

        if($limit_mode == true){
            $model->limit(10);
        }

        return $model
            ->asArray()
            ->all();
    }


    /**
     * get the total average of all semester for the desired school
     *
     * @param int $school_id school id
     * @return float
     */
    public static function getTotalAvg(int $school_id){

        $model = static::find()
            ->alias('sem')
            ->select(['ROUND(AVG(gs.grade),2) as grade'])
            ->join('FULL OUTER JOIN',['subj' => Subject::tableName()],'subj.sem_id = sem.id')
            ->leftJoin(['gs' => GradeSystem::tableName()],'gs.id = subj.grade')
            ->leftJoin(['school' => School::tableName()],'school.id = subj.school_id')
            ->andWhere('sem.school_id=:school_id',[':school_id' => $school_id]) //school parameter
            ->andWhere('sem.created_by=:user',[':user' => Yii::$app->user->id]) //user parameter
            ->groupBy(['sem.id'])
            ->column(); //group be semester id

        $new_val = ArrayUtil::alterNullValues($model);

        if(array_sum($new_val) == 0 || count($new_val) == 0){
            return 0.00;
        }

        return GradeSystem::gradesRound(array_sum($new_val)/count($new_val));
    }




    /**
     * Attempts to delete the existing semester model
     * with the associate subjects.
     *
     * @param int $id semester id
     * @param int $school_id school id
     * @return int|false
     */
    public static function deleteSemester(int $id, int $school_id){
        try{
            $semester = static::findSemester($id, $school_id);

            //check if semester have subjects
            //if does then delete it
            if(count($semester->subjects) > 0){
                foreach ($semester->subjects as $subject) {
                    $subject->delete();
                }
            }

            $is_delete = $semester->delete();
        }catch(\Exception $e){
            Yii::$app->session->setFlash('error','Something went wrong: '.$e->getMessage());
        }

        return $is_delete;
    }


    /**
     * Print semesters and the subjects under them
     *
     * @param int $school_id school id
     * @return mixed|Exception
     */
    public static function printSemesters(int $school_id){
        $model = static::fetchSemesterData($school_id,1,false);
        GradeSystem::fetchGradeData();
        $school_model = School::findSchool($school_id);



        try{
            $pdf = Yii::$app->pdf;
            $pdf->filename = StringUtil::stringReplace('Your information for school '.ucwords($school_model['name']));
            $mpdf = $pdf->api;
            $mpdf->SetTitle('Your Information for school '.ucwords($school_model['name']));
            $mpdf->SetAuthor(ucwords(Yii::$app->user->identity->username));
            $mpdf->SetHeader(Yii::$app->name.'||Generated On: ' . date("r"));
            $html = "
                <br><br>
                School: <b>".ucwords($school_model['name'])."</b><br>
                General Average: <b>".static::getTotalAvg($school_id)."</b><br>
                Created by: <b>".ucwords(Yii::$app->user->identity->username)."</b>
                <br><br><hr><br><br>
            ";
            foreach($model as $semester){
                $html .= "
                    Semester: <b>".ucwords($semester['name'])."</b><br>
                    Semester General Average: <b>".GradeSystem::gradesRound($semester['grade'])."</b><br>
                    <table class=\"table table-striped table-bordered\">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Description</th>
                                <th class=\"text-center\">Grade</th>
                            </tr>
                        </thead>
                ";
                    foreach (Subject::fetchSubjectData($school_id,$semester['id'],3,false) as $subject_model ) {
                        $html.= "
                            <tbody>
                                <tr>
                                    <td>".$subject_model['code']."</td>
                                    <td>".($subject_model['description'] ? $subject_model['description'] : 'N/A' )."</td>
                                    <td class=\"text-center \">".$subject_model['grade0']['grade']."</td>
                                </tr>
                            </tbody>
                        ";
                    }
                    $html .= "
                        </table>
                        <br><hr><br>
                    ";
            }
            $pdf->content = $html;
            $res = $pdf->render();
        }catch(\Exception $e){
            throw new \Exception("You have an exceptions: \n".$e->getMessage()."\nStack Trace: ".$e->getTraceAsString());
        }

        return $res;
    }
}

