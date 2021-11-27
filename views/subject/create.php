<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Subject */
/* @var $sem_model app\models\Semester */

use app\helpers\StringUtil;

$this->title = StringUtil::encode('Create Subject');
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['school/index']];
$this->params['breadcrumbs'][] = StringUtil::encode($sem_model['school']['name']);
$this->params['breadcrumbs'][] = ['label' => 'Semesters', 'url' => ['semester/index', 'school_id' => $sem_model['school_id']]];
$this->params['breadcrumbs'][] = ['label' => StringUtil::encode($sem_model['name']), 'url' => ['subject/index', 'school_id' => $sem_model['school_id'], 'sem_id' => $sem_model['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= $this->title ?></h1>

    <?= $this->render('components/_form', [
        'model' => $model
    ]) ?>

</div>
