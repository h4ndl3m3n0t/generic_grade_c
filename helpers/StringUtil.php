<?php

namespace app\helpers;


class StringUtil{

    /**
     * Provide data provider
     *
     * @param string $val
     * @param int $count range (default value is 4)
     * @return string
     */
    public static function encode(string $val, $count = 4){
        return \yii\helpers\StringHelper::truncateWords(\yii\helpers\Html::encode(ucwords($val)),$count);
    }

    /**
     *
     *
     * @param string $value the 'haystack' or 'subject' to be searched for.
     * @param string $symbol symbol you want to use as a replacement (default to +)
     * @return void
     */
    public static function stringReplace(string $value,string $symbol = '+'){
        return str_replace(' ',$symbol,$value);
    }
}
