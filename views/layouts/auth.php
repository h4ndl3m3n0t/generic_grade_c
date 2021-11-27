<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;

$this->beginContent('@app/views/layouts/base.php');
?>
<main class="d-flex">
    <div class="content-wrapper p-3">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?php $this->endContent() ?>
