<?php

/* @var $this yii\web\View */
/* @var $model app\models\School */
use app\helpers\StringUtil;

$this->title = StringUtil::encode('Create School');
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-create">

    <h1><?= $this->title ?></h1>

    <?= $this->render('@app/views/common/_form',['model' => $model]) ?>

</div>
