<?php

/* @var $this yii\web\View */
/* @var $model app\models\School */

use app\helpers\StringUtil;

$this->title = StringUtil::encode('Update School: ' . $model->name);
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => StringUtil::encode($model->name), 'url' => ['semester/index','school_id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="school-update">

    <h1><?= $this->title ?></h1>

    <?= $this->render('@app/views/common/_form',['model' => $model]) ?>

</div>
