<?php
use yii\bootstrap4\Html;
?>

<div class="dropdown">
    <button class="btn btn-purple dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort <?= $this->title ?>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <?php for ($i = 0; $i < count(Yii::$app->params['sort.items']); $i++): ?>
        <?= Html::a(
            Yii::$app->params['sort.items'][$i],
            [
                'school/index',
                'sort' => $i+1
            ],
            ['class' => 'dropdown-item']
        )?>
    <?php endfor; ?>
    </div>
</div>
