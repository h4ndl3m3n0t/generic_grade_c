<?php
use yii\bootstrap4\Html;

?>

<?= Html::a(
    '<i class="fas fa-edit"></i> Update',
    [
        'subject/update',
        'school_id' => $model['school_id'],
        'sem_id' => $model['sem_id'],
        'id' => $model['id']
    ],
    [
        'class' => 'btn btn-success'
    ]
    ); ?>
    <?= Html::a(
        '<i class="fas fa-trash-alt"></i> Delete',
        [
            'subject/delete',
            'school_id' => $model['school_id'],
            'sem_id' => $model['sem_id'],
            'id' => $model['id']
        ],
        [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "Are you sure you want to delete this subject?\nNote: Can't be undone after.",
                'method' => 'post',
            ],
        ]
    ); ?>
    <?= Html::a(
        '<i class="fas fa-print"></i> Print Subject',
        [
            'subject/print',
            'school_id' => $model['school_id'],
            'sem_id' => $model['sem_id'],
            'id' => $model['id']
        ],
        [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post',
            ],
            'target' => '_blank',
        ]
    ) ?>
