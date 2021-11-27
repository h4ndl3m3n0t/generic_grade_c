<?php

/* @var $dataProvider yii\data\ActiveDataProvider */
use app\helpers\StringUtil;
use yii\bootstrap4\Html;
use app\models\GradeSystem;

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
            'attribute' => 'name',
            'content' => function($model){
                return Html::a(
                StringUtil::encode($model['name'],7),
                [
                    'subject/index',
                    'school_id' => $model['school_id'],
                    'sem_id' => $model['id']
                ],
                ['class' => 'alert-link text-capitalize']);
            }
        ],
        [
            'attribute' => 'grade',
            'content' => function($model){
                return '
                <span class="font-weight-bold '.(GradeSystem::gradesRound($model['grade'] == null ? 0.00 : $model['grade']) >= 3.50 || GradeSystem::gradesRound($model['grade'] == null ? 0.00 : $model['grade']) == 0 ? 'text-danger' : 'text-success').'">'.
                    GradeSystem::gradesRound($model['grade'] == null ? 0.00 : $model['grade'])
                .'</span>';
            },
            'headerOptions' => [
                'class' => 'text-center'
            ],
            'contentOptions' => [
                'class' => 'text-center'
            ]
        ],
        [
            'label' => 'Created',
            'attribute' => 'created_at',
            'content' => function($model){
                return Yii::$app->formatter->asDateTime($model['created_at']);
            }
        ],
    ],
]); ?>
