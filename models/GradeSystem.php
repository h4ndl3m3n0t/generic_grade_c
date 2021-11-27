<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%grade_system}}".
 *
 * @property int $id
 * @property float $grade
 * @property string $equivalent
 * @property string $grade_letter
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Subject[] $subjects
 */
class GradeSystem extends \yii\db\ActiveRecord
{
    private static array $_grades;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%grade_system}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grade', 'equivalent', 'grade_letter', 'description'], 'required'],
            [['grade'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
            [['equivalent'], 'string', 'max' => 10],
            [['grade_letter'], 'string', 'max' => 2],
            [['description'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade' => 'Grade',
            'equivalent' => 'Equivalent',
            'grade_letter' => 'Grade Letter',
            'description' => 'Description',
            'created_at' => 'Created',
            'updated_at' => 'Modified',
        ];
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\SubjectQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['grade' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\GradeSystemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\GradeSystemQuery(get_called_class());
    }

    /**
     * return all the grades ('id' and 'grade' column).
     * return like this ' [id => grade] '
     * @return array
     */
    public function generateGrades(){

        return \yii\helpers\ArrayHelper::map(
            static::find()
                ->gradeSort()
                ->all(),
            'id',
            'grade'
        );
    }

    /**
     * initialize the grades variable with the all the grades in it
     *
     * @return void
     */
    public static function fetchGradeData(){
        static::$_grades = self::find()
            ->asArray()
            ->all();
    }

    /**
     * Return the grade equivalent of a value
     * sample:
     * 1.88 = 2.00, etc.
     *
     * @param float $val
     * @return float $grade
     */
    public static function gradesRound(float $val){

        //if val = 0 then just return 0.00
        if($val == 0){
            return 0.00;
        }

        foreach (static::$_grades as $grade) {
            if($val <= $grade['grade']){
                $grade = $grade['grade'];
                break;
            }
        }
        return $grade;
    }
}
