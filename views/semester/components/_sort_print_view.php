<?php

/* @var $school_model app\models\School */
use yii\bootstrap4\Html;

?>

<div class="dropdown mr-2">
  <button class="btn btn-purple dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Sort Semesters
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <?php for ($i = 0; $i < (count(Yii::$app->params['sort.items'])); $i++): ?>
    <?= Html::a(
      Yii::$app->params['sort.items'][$i],
      [
        'semester/index',
        'school_id' => $school_model['id'],
        'sort' => $i+1
      ],
      ['class' => 'dropdown-item']
    )?>
  <?php endfor; ?>
  </div>
</div>

<?= Html::a(
  '<i class="fas fa-print"></i> Print Semesters',
  [
    'semester/print',
    'school_id' => $school_model['id']
  ],
  [
    'class' => 'btn btn-primary',
    'data' => [
      'method' => 'post',
    ],
    'target' => '_blank',
  ]
) ?>
