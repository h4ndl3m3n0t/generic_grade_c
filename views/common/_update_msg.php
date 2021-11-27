<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Update <b>&quot;<?= $name ?>&quot;</b>.</h4>
  <p>
    To update this item click
    <?= \yii\bootstrap4\Html::a('here', $route,[
        'class' => 'alert-link'
      ]) ?>.
  </p>
</div>
