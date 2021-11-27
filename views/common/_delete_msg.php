<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Delete <b>&quot;<?= $name ?>&quot;</b>!!!</h4>
  <p>
    To delete this item click
    <?= \yii\bootstrap4\Html::a('here', $route,[
        'class' => 'alert-link',
        'data' => [
          'confirm' => "Are you sure you want to delete this item?\nNote: Can't be undone after.",
          'method' => 'post',
        ],
      ]) ?>.
  </p>
</div>
