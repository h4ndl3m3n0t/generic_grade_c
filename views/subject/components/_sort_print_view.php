<?php

/* @var $sem_model app\models\Semester */
use yii\bootstrap4\Html;
?>

<div class="dropdown mr-2">
    <button class="btn btn-purple dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort Subjects
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php for ($i=0; $i < count(Yii::$app->params['sort.items']); $i++): ?>
            <?= yii\bootstrap4\Html::a(
                Yii::$app->params['sort.items'][$i],
                [
                    'subject/index',
                    'school_id' => $sem_model['school_id'],
                    'sem_id' => $sem_model['id'],
                    'sort' => $i+1
                ],
                ['class' => 'dropdown-item']
            )?>
        <?php endfor; ?>
    </div>
</div>
    <?= Html::a(
    '<i class="fas fa-print"></i> Print Subject',
    [
        'subject/print',
        'school_id' => $sem_model['school_id'],
        'sem_id' => $sem_model['id']
    ],
    [
        'class' => 'btn btn-primary',
        'data' => [
            'method' => 'post',
        ],
        'target' => '_blank',
    ]
    ) ?>
