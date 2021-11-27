<?php

/* @var $this yii\web\View */
/* @var $model app\models\Subject */
/* @var $form yii\bootstrap4\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->dropDownList(
        (new \app\models\GradeSystem())->generateGrades()
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
