<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\GradeSystem]].
 *
 * @see \app\models\GradeSystem
 */
class GradeSystemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\GradeSystem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\GradeSystem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Sort the grade in ascending order via created_at col
     *
     * @return $this
     */
    public function gradeSort(){
        return $this->orderBy(['created_at' => SORT_ASC]);
    }
}
