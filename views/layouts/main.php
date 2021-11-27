<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
$items = [
    [
        'label' => '<i class="fas fa-tachometer-alt"></i> Dashboard',
        'url' => ['dashboard/index']
    ],
    [
        'label' => '<i class="fas fa-user-cog"></i> Settings',
        'url' => ['dashboard/settings']
    ],
];
$this->beginContent('@app/views/layouts/base.php');
?>
<main class="d-flex frm-white">
    <?= $this->render('@app/views/common/_sidebar_nav',['items' => $items]) ?>

    <div class="content-wrapper p-3">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => "Dashboard",
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?php $this->endContent() ?>
