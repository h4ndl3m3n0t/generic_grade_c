<?php

namespace app\helpers;

class SortUtil{

    /**
     * Sort schools
     *
     * @param integer $sort
     * @param \yii\db\ActiveRecord $model
     * @return void
     */
    public static function sort(int $sort, $model){
        switch ($sort) {
            case 1: //date ascending
                $model->old();
                break;

            case 2: //date descending
                $model->latest();
                break;

            case 3: //name ascending
                $model->nameUp();
                break;

            case 4: //name descending
                $model->nameDown();
                break;

            case 5: //grade ascending
                $model->gradeUp();
                break;

            case 6: //grade descending
                $model->gradeDown();
                break;

            default:
                $model->latest(); //redundancy if necessary
                break;
        }

    }
}
