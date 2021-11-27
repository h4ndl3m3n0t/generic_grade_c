<?php
namespace app\helpers;


class ArrayUtil{



  /**
   * alter array, by remove all null or 0 values inside an array.
   *
   * @param array $model
   * @param int $mode what mode to be used (mode: 2 - is for grades)
   * @return array
   */
  public static function alterNullValues(array $model, int $mode = 1){
    $temp = [];

    switch($mode){
      case 1: //remove null values
        for ($i=0; $i < count($model); $i++) {
          if($model[$i] != null){
            $temp[] = \app\models\GradeSystem::gradesRound($model[$i]);
          }
        }
        break;

      case 2://for remove null values in the grades
        for ($i=0; $i < count($model); $i++) {
          if((float) $model[$i]['grade0']['grade'] !== 0.00){
            $temp[] = (float) $model[$i]['grade0']['grade'];
          }
        }
        break;
    }
    return $temp;
  }
}
