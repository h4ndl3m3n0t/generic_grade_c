<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">No <b><?= $name ?>(s)</b> added! :(</h4>
  <p>
    You have not added any <?= $name ?>, try creating one
    <?= \yii\bootstrap4\Html::a('here', $route,['class' => 'alert-link']) ?>.
  </p>
</div>
