<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\School */
/* @var $gen_ave_sem float */

use app\helpers\StringUtil;

$this->title = StringUtil::encode('School');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-index">

    <?php if(count($model) >= 1): ?>
        <?= $this->render('@app/views/common/_header_nav',[
            'brandLabel' => 'List of Schools',
            'brandUrl' => null,
            'items' => [
                [
                    'label' => '<i class="fas fa-plus-circle"></i> Add School',
                    'url' => ['school/create'],
                    'linkOptions' => [
                        'class' => 'btn btn-primary'
                    ]
                ]
            ]
        ]) ?>


        <div class="d-flex justify-content-between p-2">
            <div>
                General Average for this semester:
                <span class="font-weight-bold <?= $gen_ave_sem >= 3.50 || $gen_ave_sem == 0 ? 'text-danger' : 'text-success' ?>">
                    <?= $gen_ave_sem ?>
                </span>
            </div>
            <div>
                <?= $this->render('components/_sort_view') ?>
            </div>
        </div>


        <?= $this->render('components/_grid_view',[
            'dataProvider' => $dataProvider
        ]) ?>

    <?php else: ?>
        <?= $this->render('components/_default_view',[
            'title' => $this->title
        ]) ?>
    <?php endif; ?>
</div>
