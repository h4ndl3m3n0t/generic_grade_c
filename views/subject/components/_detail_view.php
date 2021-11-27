<?php

/* @var $model app\models\Subject */

use yii\widgets\DetailView;
?>

<?= DetailView::widget([
  'model' => $model,
  'attributes' => [
    [
      'label' => 'Code',
      'value' => ucwords($model['code']),
      'contentOptions' => [
          'class' => 'font-weight-bold'
      ],
    ],
    [
      'label' => 'Description',
      'value' => ucwords($model['description'] ? $model['description'] : 'N/A'),
      'contentOptions' => [
          'class' => 'font-weight-bold'
      ],
    ],
    [
      'label' => 'Grade',
      'value' => $model['grade0']['grade'].' (equivalent to: '.$model['grade0']['equivalent'].' / '.$model['grade0']['grade_letter'].' / '.$model['grade0']['description'].')',
      'contentOptions' => [
          'class' => 'font-weight-bold '.($model['grade0']['grade'] >= 3.50 || $model['grade0']['grade'] == 0.00 ? 'text-danger' : 'text-success')
      ],
    ],
    [
      'label' => 'Semester',
      'value' => $model['semester']['name'],
      'contentOptions' => [
          'class' => 'font-weight-bold'
      ],
    ],
    [
      'label' => 'School',
      'value' => $model['school']['name'],
      'contentOptions' => [
          'class' => 'font-weight-bold'
      ],
    ],
    [
      'label' => 'Created By',
      'value' => ucwords($model['createdBy']['username']),
      'contentOptions' => [
          'class' => 'font-weight-bold'
      ],
    ],
    'created_at:datetime',
    'updated_at:datetime',
  ],
])?>
