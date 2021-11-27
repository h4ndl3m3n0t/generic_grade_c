<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Request password reset';
?>
<div class="site-request-password-reset">

    <section class="ftco-section">
		<div class="container pt-5 pb-5">
			<div class="row justify-content-center">
                <div class="frm-white col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-4">
                        <h1 class="heading-section text-center mb-5"><?= Html::encode($this->title) ?></h1>
                        <h5 class="text-center mb-4">Please fill out your email. A link to reset password will be sent there.</h5>

                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                            <?= $form->errorSummary($model) ?>

                            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                            <div class="form-group d-md-flex">
                                <div style="color:#999;margin:1em 0">
                                    Have an existing account? <?= Html::a('Login', ['site/login']) ?>.
                                    <br>
                                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                                    <br>
                                    Create account? <?= Html::a('Signup', ['site/signup']) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('Send', ['class' => 'btn btn-purple w-100', 'name' => 'request-password-reset-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
	</section>
</div>
