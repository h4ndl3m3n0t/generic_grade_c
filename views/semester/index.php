<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Semester */
/* @var $school_model app\models\School */
/* @var $gen_ave_sem float */

use app\helpers\StringUtil;

$this->title = StringUtil::encode($school_model['name']);
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['school/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="school-view">


    <?php if(count($model) >= 1): ?>
        <?= $this->render('@app/views/common/_header_nav',[
            'brandLabel' => '<h3>School Name: &quot;<span class="font-weight-bold">'.$this->title.'</span>&quot;</h3>',
            'brandUrl' => null,
            'items' => [
                [
                    'label' => '<i class="fas fa-plus-circle"></i> Add Semester',
                    'url' => ['semester/create','school_id' => $school_model['id']],
                    'linkOptions' => [
                        'class' => 'btn btn-primary mr-2'
                    ]
                ],
                [
                    'label' => '<i class="fas fa-edit"></i> Update School',
                    'url' => ['school/update','id' => $school_model['id']],
                    'linkOptions' => [
                        'class' => 'btn btn-success mr-2'
                    ]
                ],
                [
                    'label' => '<i class="fas fa-trash-alt"></i> Delete School',
                    'url' => ['school/delete','id' => $school_model['id']],
                    'linkOptions' => [
                        'data' => [
                            'confirm' => "Are you sure you want to delete this school?\nNote: Can't be undone after.",
                            'method' => 'post',
                        ],
                        'class' => 'btn btn-danger mr-2'
                    ]
                ]
            ]
        ]) ?>


        <div class="d-flex justify-content-between p-2">
            <div>
                General Average for this school:
                <span class="font-weight-bold <?= $gen_ave_sem >= 3.50 || $gen_ave_sem == 0 ? 'text-danger' : 'text-success' ?>">
                    <?= $gen_ave_sem ?>
                </span>
            </div>
            <div  class="d-flex justify-content-end p-2">
                <?= $this->render('components/_sort_print_view',['school_model' => $school_model]) ?>
            </div>
        </div>

        <?= $this->render('components/_grid_view',['dataProvider' => $dataProvider]) ?>
    <?php else: ?>

        <?= $this->render('components/_default_view',['title' => $this->title, 'school_model' => $school_model]) ?>
    <?php endif; ?>

</div>
