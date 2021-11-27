<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Semester]].
 *
 * @see \app\models\Semester
 */
class SemesterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Semester[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Semester|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


    /**
     * return data via date(created_at) in descending order
     *
     * @return $this
     */
    public function latest()
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * return data via date(created_at) in ascending order
     *
     * @return $this
     */
    public function old(){
        return $this->orderBy(['created_at' => SORT_ASC]);
    }

    /**
     * return data via name in descending order
     *
     * @return $this
     */
    public function nameDown()
    {
        return $this->orderBy(['name' => SORT_DESC]);
    }

    /**
     * return data via name in descending order
     *
     * @return $this
     */
    public function nameUp()
    {
        return $this->orderBy(['name' => SORT_ASC]);
    }

    /**
     * get via author
     *
     * @param integer $author
     * @return $this
     */
    public function author(int $author)
    {
        return $this->andWhere(['created_by' => $author]);
    }

    /**
     * get via school
     *
     * @param integer $school
     * @return $this
     */
    public function school(int $school)
    {
        return $this->andWhere(['school_id'=> $school]);
    }

    /**
     * return data via grade in descending order
     *
     * @return $this
     */
    public function gradeDown()
    {
        return $this->orderBy(['grade' => SORT_DESC]);
    }

    /**
     * return data via grade in descending order
     *
     * @return $this
     */
    public function gradeUp()
    {
        return $this->orderBy(['grade' => SORT_ASC]);
    }
}
