<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\helpers\SortUtil;
use app\helpers\ArrayUtil;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%school}}".
 *
 * @property int $id
 * @property string $name
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property Semester[] $semesters
 * @property Subject[] $subjects
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%school}}';
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
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 1024],
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
            'name' => 'School Name',
            'created_by' => 'Created By',
            'created_at' => 'Created',
            'updated_at' => 'Modified',
        ];
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
     * Gets query for [[Semesters]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SemesterQuery
     */
    public function getSemesters()
    {
        return $this->hasMany(Semester::class, ['school_id' => 'id']);
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SubjectQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['school_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\SchoolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SchoolQuery(get_called_class());
    }


    /**
     * Finds the School model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id school id
     * @return School|array|null the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findSchool(int $id)
    {
        if (($school_model = static::find()
            ->andWhere([
                'id' => $id
            ])
            ->author(Yii::$app->user->id)
            ->one()) !== null) {
            return $school_model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Lists all School models.
     * @param integer $sort sort mode
     * @param bool $limit_mode add a limit of '10' per page (set 'true' by default)
     * @return mixed
     */
    public static function fetchSchoolData(int $sort, bool $limit_mode = true){

        $model = static::find()
            ->alias('school')
            ->select(['school.*,ROUND(AVG(gs.grade),2) as grade'])
            ->join('FULL OUTER JOIN',['subj' => Subject::tableName()],'subj.school_id = school.id')
            ->leftJoin(['gs' => GradeSystem::tableName()],'gs.id = subj.grade')
            ->leftJoin(['sem' => Semester::tableName()],'sem.school_id = subj.school_id')
            ->andWhere('school.created_by=:user',[':user' => Yii::$app->user->id]) //user parameter
            ->groupBy(['school.id']); //group be semester id

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
     * @return float
     */
    public static function getTotalAvg(){

        $model = static::find()
            ->alias('school')
            ->select(['ROUND(AVG(gs.grade),2) as grade'])
            ->join('FULL OUTER JOIN',['subj' => Subject::tableName()],'subj.school_id = school.id')
            ->leftJoin(['gs' => GradeSystem::tableName()],'gs.id = subj.grade')
            ->leftJoin(['sem' => Semester::tableName()],'sem.school_id = subj.school_id')
            ->andWhere('school.created_by=:user',[':user' => Yii::$app->user->id]) //user parameter
            ->groupBy(['school.id'])
            ->column(); //group be semester id

        $new_val = ArrayUtil::alterNullValues($model);

        if(array_sum($new_val) == 0 || count($new_val) == 0){
            return 0.00;
        }

        return GradeSystem::gradesRound(array_sum($new_val)/count($new_val));
    }


    /**
     * Attempts to delete the existing school model
     * with the associate semesters.
     *
     * @param int $id school id
     * @return int|false
     */
    public static function deleteSchool(int $id){
        try{
            $school = static::findSchool($id);

            //check if school have semesters
            //if does then delete it
            if(count($school->semesters) > 0){
                foreach ($school->semesters as $semester) {

                    //check if semester have subjects
                    //if does then delete it
                    if(count($semester->subjects) > 0){
                        foreach($semester->subjects as $subject){
                            $subject->delete();
                        }
                    }
                    $semester->delete();
                }
            }

            return $school->delete();
        }catch(\Exception $e){
            Yii::$app->session->setFlash('error','Something went wrong: '.$e->getMessage());
        }
    }
}


