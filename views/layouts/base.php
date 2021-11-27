<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap4\Html;
use app\assets\AppAsset;

AppAsset::register($this);

$items = [];
    if(!Yii::$app->user->isGuest){
        $items = [
            [
                'label' => '<i class="fas fa-door-open"></i> Logout',
                'url' => ['site/logout'],
                'linkOptions' => [
                    'data' => [
                        'method' => 'post'
                    ],
                    'class' => 'btn btn-danger'
                ]
            ]
        ];
    }
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode(\Yii::$app->name.($this->title ? ' | '.$this->title : '')) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap h-100 d-flex flex-column">
    <div class="wrap h-100 d-flex flex-column">
        <?php echo $this->render('@app/views/common/_header_nav',[
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->user->isGuest ? yii::$app->homeUrl : ['dashboard/index'],
            'items' => $items
        ]) ?>
        <?php echo $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
