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
                        return Html::a(
                            StringUtil::encode($model['code'],4),
                            [
                                'subject/view',
                                'school_id' => $model['school_id'],
                                'sem_id' => $model['sem_id'],
                                'id' => $model['id']
                            ],
                            [
                                'class' => 'alert-link'
                            ]
                        );
                    }
                ],
                [
                    'attribute' => 'description',
                    'content' => function($model){
                        return $model['description'] ? (Html::a(
                            StringUtil::encode($model['description'],10),
                            [
                                'subject/view',
                                'school_id' => $model['school_id'],
                                'sem_id' => $model['sem_id'],
                                'id' => $model['id']
                            ]
                        )) : 'N/A';
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
                [
                    'header' => 'Actions',
                    'class' => '\yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function($url,$model,$key){
                            return Html::a(
                                '<i class="fas fa-edit"></i> Update',
                                [
                                    'subject/update',
                                    'school_id' => $model['school_id'],
                                    'sem_id' => $model['sem_id'],
                                    'id' => $model['id']
                                ],
                                [
                                    'class' => 'btn btn-success'
                                ]
                            );
                        },
                        'delete' => function($url,$model,$key){
                            return Html::a(
                                '<i class="fas fa-trash-alt"></i> Delete',
                                [
                                    'subject/delete',
                                    'school_id' => $model['school_id'],
                                    'sem_id' => $model['sem_id'],
                                    'id' => $model['id']
                                ],
                                [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => "Are you sure you want to delete this subject?\nNote: Can't be undone after.",
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        }
                    ],
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ]
                ]
            ],
        ]); ?>
