<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Subject */
/* @var $sem_model app\models\Semester */
/* @var $gen_ave float */

use app\helpers\StringUtil;

$this->title = StringUtil::encode($sem_model['name']);
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['school/index']];
$this->params['breadcrumbs'][] = StringUtil::encode($sem_model['school']['name']);
$this->params['breadcrumbs'][] = ['label' => 'Semesters', 'url' => ['semester/index', 'school_id' => $sem_model['school_id']]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="school-view">



    <?php if(count($model) >= 1): ?>
        <?= $this->render('@app/views/common/_header_nav',[
            'brandLabel' => '<h3>Semester: &quot;<span class="font-weight-bold">'.$this->title.'</span>&quot;</h3>',
            'brandUrl' => null,
            'items' => [
                [
                    'label' => '<i class="fas fa-plus-circle"></i> Add Subjects',
                    'url' => [
                        'subject/create',
                        'school_id' => $sem_model['school_id'],
                        'sem_id' => $sem_model['id']
                    ],
                    'linkOptions' => [
                        'class' => 'btn btn-primary mr-2'
                    ]
                ],
                [
                    'label' => '<i class="fas fa-edit"></i> Update Sem',
                    'url' => [
                        'semester/update',
                        'school_id' => $sem_model['school_id'],
                        'sem_id' => $sem_model['id']
                    ],
                    'linkOptions' => [
                        'class' => 'btn btn-success mr-2'
                    ]
                ],
                [
                    'label' => '<i class="fas fa-trash-alt"></i> Delete Sem',
                    'url' => [
                        'semester/delete',
                        'school_id' => $sem_model['school_id'],
                        'id' => $sem_model['id']
                    ],
                    'linkOptions' => [
                        'data' => [
                            'confirm' => "Are you sure you want to delete this semester?\nNote: Can't be undone after.",
                            'method' => 'post',
                        ],
                        'class' => 'btn btn-danger mr-2'
                    ]
                ]
            ]
    ]) ?>


        <div class="d-flex justify-content-between p-2">
            <div>
                General Average for this semester:
                <span class="font-weight-bold <?= $gen_ave >= 3.50 || $gen_ave == 0 ? 'text-danger' : 'text-success' ?>">
                    <?= $gen_ave ?>
                </span>
            </div>
            <div class="d-flex justify-content-end p-2">
                <?= $this->render('components/_sort_print_view',['sem_model' => $sem_model]) ?>
            </div>
        </div>

        <?= $this->render('components/_grid_view',['dataProvider' => $dataProvider]) ?>
    <?php else: ?>
        <?= $this->render('components/_default_view',['sem_model' => $sem_model]) ?>
    <?php endif; ?>

</div>
