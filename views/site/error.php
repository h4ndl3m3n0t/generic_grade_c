<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <section class="ftco-section">
		<div class="container pt-5 pb-5">
			<div class="row justify-content-center">
                <div class="frm-white col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-4">

                        <h1 class="heading-section text-center mb-5"><?= Html::encode($this->title) ?> :(</h1>

                        <div class="alert alert-danger">
                            <?= nl2br(Html::encode($message)) ?>
                        </div>

                        <p>
                            The above error occurred while the Web server was processing your request.
                        </p>
                        <p>
                            Please contact us if you think this is a server error. Thank you.
                        </p>
                    </div>
                </div>
            </div>
        </div>
	</section>
</div>
