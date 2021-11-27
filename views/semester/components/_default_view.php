<?php

/* @var $school_model app\models\School */
/* @var $title */

?>

<?= $this->render('@app/views/common/_empty_msg',[
    'name' => 'semester',
    'route' => ['semester/create','school_id' => $school_model['id']]
]) ?>

<?= $this->render('@app/views/common/_update_msg',[
    'name' => $title,
    'route' => [
        'school/update',
        'id' => $school_model['id']
    ]
]) ?>

<?= $this->render('@app/views/common/_delete_msg',[
    'name' => $title,
    'route' => [
        'school/delete',
        'id' => $school_model['id'],
    ]
]) ?>
