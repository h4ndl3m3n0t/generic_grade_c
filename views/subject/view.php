<?php

/* @var $this yii\web\View */
/* @var $model app\models\Subject */

use app\helpers\StringUtil;

$this->title = StringUtil::encode('View Subject: ' . $model['code']);
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['school/index']];
$this->params['breadcrumbs'][] = StringUtil::encode($model['semester']['school']['name']);
$this->params['breadcrumbs'][] = ['label' => 'Semesters', 'url' => ['semester/index', 'school_id' => $model['school_id']]];
$this->params['breadcrumbs'][] = ['label' => StringUtil::encode($model['semester']['name']), 'url' => ['subject/index', 'school_id' => $model['school_id'], 'sem_id' => $model['sem_id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-view">

    <h1><?= StringUtil::encode($this->title,5) ?></h1>


    <div class="d-flex justify-content-end p-2">
        <div>
            <?= $this->render('components/_detail_view_buttons',['model' => $model]) ?>
        </div>
    </div>

    <?= $this->render('components/_detail_view',['model' => $model]) ?>

</div>
