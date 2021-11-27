<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Signup';
?>
<div class="site-signup">
    <section class="ftco-section">
		<div class="container pt-5 pb-5">
			<div class="row justify-content-center">
                <div class="frm-white col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-4">
                        <h1 class="heading-section text-center mb-5"><?= Html::encode($this->title) ?></h1>
                        <h5 class="text-center mb-4">Please fill out the following fields to signup:</h5>

                        <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

                            <?= $form->errorSummary($model) ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'confirm_password')->passwordInput() ?>

                            <div class="form-group d-md-flex">
                                <div style="color:#999;margin:1em 0">
                                    Have an existing account? <?= Html::a('Login', ['site/login']) ?>
                                    <br>
                                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                                    <br>
                                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('Signup', ['class' => 'btn btn-purple w-100', 'name' => 'signup-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
	</section>
</div>
