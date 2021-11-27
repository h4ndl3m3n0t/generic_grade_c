<?php


/* @var $this yii\web\View */
/* @var $model app\models\Subject */

use app\helpers\StringUtil;

$this->title = StringUtil::encode('Update Subject: ' . $model['code']);
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['school/index']];
$this->params['breadcrumbs'][] = StringUtil::encode($model['semester']['school']['name']);
$this->params['breadcrumbs'][] = ['label' => 'Semesters', 'url' => ['semester/index', 'school_id' => $model['school_id']]];
$this->params['breadcrumbs'][] = ['label' => StringUtil::encode($model['semester']['name']), 'url' => ['subject/index', 'school_id' => $model['school_id'], 'sem_id' => $model['sem_id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-update">

    <h1><?= $this->title ?></h1>

    <?= $this->render('components/_form', [
        'model' => $model,
    ]) ?>

</div>
