<?php

/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\bootstrap4\Html;
use app\helpers\StringUtil;
?>

<?= yii\grid\GridView::widget([
  'dataProvider' => $dataProvider,
  'pager' => [
      'class' => \yii\bootstrap4\LinkPager::class,
  ],
  'columns' => [
    [
      'class' => 'yii\grid\SerialColumn',
      'headerOptions' => [
        'class' => 'text-center'
      ],
      'contentOptions' => [
        'class' => 'text-center'
      ]
    ],
    [
      'attribute' => 'code',
      'content' => function($model){
        return $model['code'];
        }
    ],
    [
      'attribute' => 'description',
      'content' => function($model){
        return $model['description'] ? $model['description'] : 'N/A';
        }
    ],
    [
        'attribute' => 'grade',
        'content' => function($model){
            return '
                <span class="font-weight-bold '.($model['grade0']['grade'] >= 3.50 || $model['grade0']['grade'] == 0 ? 'text-danger' : 'text-success').'">'.$model['grade0']['grade'].'</span>
            ';
        },
        'headerOptions' => [
            'class' => 'text-center'
        ],
        'contentOptions' => [
            'class' => 'text-center'
        ]
    ],
  ],
]); ?>
