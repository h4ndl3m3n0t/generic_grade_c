<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">

    <section class="ftco-section">
		<div class="container pt-5 pb-5">
			<div class="row justify-content-center">
                <div class="frm-white col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-4">
                        <h1 class="heading-section text-center mb-5"><?= Html::encode($this->title) ?></h1>
                        <h5 class="text-center mb-4">Please fill out the following fields to login:</h5>
                        <div class="alert alert-purple" role="alert">
                            <h5 class="alert-header">Default User account</h5>
                            <hr>
                            <h6>Username: <span class="font-weight-bold">seeker</span></h6>
                            <h6>Password: <span class="font-weight-bold">seekmenot</span></h6>
                            <hr>
                            <h6>Username: <span class="font-weight-bold">handler</span></h6>
                            <h6>Password: <span class="font-weight-bold">handlermenot</span></h6>

                        </div>

                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->errorSummary($model) ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div class="form-group d-md-flex">
                                <div style="color:#999;margin:1em 0">
                                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                                    <br>
                                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                                    <br>
                                    Create account? <?= Html::a('Signup', ['site/signup']) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-purple w-100', 'name' => 'login-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
	</section>
</div>
