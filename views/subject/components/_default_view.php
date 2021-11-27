<?php

/* @var $sem_model app\models\Semester */
?>

<?= $this->render('@app/views/common/_empty_msg',[
  'name' => 'subject',
  'route' => [
      'subject/create',
      'school_id' => $sem_model['school_id'],
      'sem_id' => $sem_model['id']
  ]
]) ?>

<?= $this->render('@app/views/common/_update_msg',[
  'name' => $sem_model['name'],
  'route' => [
      'semester/update',
      'school_id' => $sem_model['school_id'],
      'id' => $sem_model['id']
  ]
]) ?>

<?= $this->render('@app/views/common/_delete_msg',[
  'name' => $sem_model['name'],
  'route' => [
      'semester/delete',
      'school_id' => $sem_model['school_id'],
      'id' => $sem_model['id']
  ]
]) ?>
