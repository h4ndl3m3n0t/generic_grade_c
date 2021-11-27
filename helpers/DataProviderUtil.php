<?php

namespace app\helpers;

use yii\data\ArrayDataProvider;

class DataProviderUtil{

    /**
     * Provide data for the grid view
     *
     * @param \yii\db\ActiveRecord $model
     * @return \yii\data\ActiveDataProvider|null
     */
    public static function getDataProvider($model){
        return new ArrayDataProvider([
            'allModels' => $model,
            'sort' => false,
            'pagination' => [ 'pageSize' => 10 ]
        ]);
    }

    /**
     * Provide (all) data for the print view
     *
     * @param \yii\db\ActiveRecord $model
     * @return \yii\data\ActiveDataProvider|null
     */
    public static function getDataPrintProvider($model){
        return new ArrayDataProvider([
            'allModels' => $model,
            'sort' => false
        ]);
    }
}
