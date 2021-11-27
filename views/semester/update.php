<?php

/* @var $this yii\web\View */
/* @var $model app\models\Semester */

use app\helpers\StringUtil;


$this->title = StringUtil::encode('Update Semester: '.$model->name);
$this->params['breadcrumbs'][] = ['label' => 'School', 'url' => ['school/index']];
$this->params['breadcrumbs'][] = ['label' => StringUtil::encode($model->school->name), 'url' => ['index', 'school_id' => $school_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-update">

    <h1><?= $this->title ?></h1>


    <?= $this->render('@app/views/common/_form',['model' => $model]) ?>

</div>
