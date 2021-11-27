<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\helpers\ArrayUtil;
use app\helpers\SortUtil;
use app\helpers\StringUtil;
use app\helpers\DataProviderUtil;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%subject}}".
 *
 * @property int $id
 * @property string $code
 * @property string|null $description
 * @property float $grade
 * @property int $sem_id
 * @property int $school_id
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property GradeSystem $grade0
 * @property School $school
 * @property Semester $sem
 * @property User $createdBy
 */
class Subject extends \yii\db\ActiveRecord
{
    public int $schoolId;
    public int $semId;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subject}}';
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
            [['code', 'grade'], 'required'],
            [['grade'], 'number'],
            [['sem_id', 'school_id', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 256],
            [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => School::class, 'targetAttribute' => ['school_id' => 'id']],
            [['sem_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::class, 'targetAttribute' => ['sem_id' => 'id']],
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
            'code' => 'Code',
            'description' => 'Description',
            'grade' => 'Grade',
            'sem_id' => 'Sem ID',
            'school_id' => 'School ID',
            'created_by' => 'Created By',
            'created_at' => 'Created',
            'updated_at' => 'Modified',
        ];
    }


    /**
     * Gets query for [[Grade0]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\GradeSystemQuery
     */
    public function getGrade0()
    {
        return $this->hasOne(GradeSystem::class, ['id' => 'grade']);
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
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SemesterQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semester::class, ['id' => 'sem_id']);
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
     * {@inheritdoc}
     * @return \app\models\query\SubjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SubjectQuery(get_called_class());
    }


    /**
     * Finds the Subject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id the subject id
     * @param integer $sem_id the semester id
     * @param integer $school_id the school id
     * @return Subject|array|null the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findSubject(int $id, int $sem_id, int $school_id)
    {
        if (($model = static::find()
            ->andWhere([
                'id' => $id
            ])
            ->semester($sem_id)
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
     * @param integer $sem_id semester id
     * @param integer $sort sort by name, date and grade
     * @param bool $limit_mode add a limit of '10' per page (default by true)
     * @return mixed
     */
    public static function fetchSubjectData(int $school_id, int $sem_id, int $sort, bool $limit_mode = true){
        $model = static::find()
            ->semester($sem_id)
            ->school($school_id)
            ->author(Yii::$app->user->id);

        SortUtil::sort($sort, $model);

        if($limit_mode == true){
            $model->limit(10);
        }

        return $model
            ->all();
    }

    /**
     * get the average grade of the selected semester
     *
     * @param int $school_id school id
     * @param int $sem_id semester id
     * @return float
     */
    public static function getAvgPerSubject(int $school_id, int $sem_id){

        $model = static::find()
            ->semester($sem_id)
            ->school($school_id)
            ->author(Yii::$app->user->id)
            ->all();


        $new_val = ArrayUtil::alterNullValues($model,2);

        if(array_sum($new_val) == 0 || count($new_val) == 0){
            return 0.00;
        }

        return GradeSystem::gradesRound(array_sum($new_val)/count($new_val));
    }


    /**
     * Print a subject
     *
     * @param int $school_id school id
     * @param int $sem_id semester id
     * @param int $id subject id
     * @return mixed|Exception
     */
    public static function printSubject(int $school_id, int $sem_id, int $id){
        $model = static::findSubject($id,$sem_id,$school_id);

        try{
            $pdf = Yii::$app->pdf;
            $pdf->filename = StringUtil::stringReplace('Information for subject '.ucwords($model['code']));
            $pdf->content = Yii::$app->view->render('@app/views/subject/components/_detail_view',['model' => $model]);
            $mpdf = $pdf->api;
            $mpdf->SetHeader(Yii::$app->name.'||Generated On: ' . date("r"));
            $res = $pdf->render();
        }catch(\Exception $e){
            throw new \Exception("You have an exceptions: \n".$e->getMessage()."\nStack Trace: ".$e->getTraceAsString());
        }

        return $res;
    }

    /**
     * Print subjects for the selected semester
     *
     * @param int $school_id school id
     * @param int $sem_id semester id
     * @return mixed|Exception
     */
    public static function printSubjects(int $school_id, int $sem_id){
        $model = static::fetchSubjectData($school_id,$sem_id,3,false);

        GradeSystem::fetchGradeData();

        try{
            $pdf = Yii::$app->pdf;
            $pdf->filename = StringUtil::stringReplace('Information for semester '.ucwords($model[0]['semester']['name']));
            $mpdf = $pdf->api;
            $mpdf->SetHeader(Yii::$app->name.'||Generated On: ' . date("r"));
            $mpdf->WriteHTML("<br><br>");
            $mpdf->WriteHTML("School: <b>".ucwords($model[0]['school']['name'])."</b>");
            $mpdf->WriteHTML("Semester: <b>".ucwords($model[0]['semester']['name'])."</b>");
            $mpdf->WriteHTML("Semester General Average: <b>".static::getAvgPerSubject($school_id,$sem_id)."</b>");
            $mpdf->WriteHTML("<br><br><hr><br><br>");
            $pdf->content = Yii::$app->view->render('@app/views/subject/components/_print_grid_view',[
                'dataProvider' => DataProviderUtil::getDataPrintProvider($model)
            ]);
            $res = $pdf->render();
        }catch(\Exception $e){
            throw new \Exception("You have an exceptions: \n".$e->getMessage()."\nStack Trace: ".$e->getTraceAsString());
        }

        return $res;
    }



}
