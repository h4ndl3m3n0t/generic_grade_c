<?php

/* @var $form yii\bootstrap4\ActiveForm */
/* @var $this yii\web\View */


use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model) ?>

<?= $form->field($model, 'name')->textArea([
    'autofocus' => true,
]) ?>

<div class="form-group float-right">
    <?= Html::submitButton(
        '<i class="fas fa-save"></i> Save',
        ['class' => 'btn btn-purple']
    ) ?>
</div>

<?php ActiveForm::end(); ?>
