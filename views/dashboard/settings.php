<?php
/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use app\helpers\StringUtil;

$this->title = StringUtil::encode('User Settings');
?>
<h1>
    <?= $this->title ?>
    for &quot;<?= Yii::$app->user->identity->username ?>&quot;
</h1>


<div class="alert alert-primary" role="alert">
    <h3 class="alert-heading">&quot;Grade Compiler 2.0 &quot; </h3>
    <p>
        Grade Compiler - compiles your grade via encoding your grades and show your general average via sem or school. Enjoy using it. =)
    </p>
</div>

<div class="alert alert-success" role="alert">
    <h3 class="alert-heading">&quot;Update Password&quot; Section</h3>
    <p>
        Update your password
        <?= Html::a('here', ['site/request-password-reset'], [
            'class' => 'alert-link'
        ]) ?>.
    </p>
</div>

<div class="alert alert-danger" role="alert">
    <h3 class="alert-heading">&quot;Delete Account&quot; Section</h3>
    <p>
        Delete your account
        <?= Html::a('here', ['settings/delete-account'], [
            'class' => 'alert-link',
            'data' => [
                'confirm' => "Are you sure you want to delete your account?\nNote: Can't be undone after.",
                'method' => 'post',
            ]
        ]) ?>.
    </p>
    <p class="mb-0">Note: There is no turning back when you delete you account.</p>
</div>

