<?php
/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use app\helpers\StringUtil;

$this->title = StringUtil::encode('Dashboard');
?>
<h1>
  <?= $this->title ?>
  &lpar;login as user &quot;<?= Yii::$app->user->identity->username ?>&quot;&rpar;
</h1>


<div class="alert alert-purple" role="alert">
  <h3 class="alert-heading">&quot;School&quot; Section</h3>
  <p>
    View all the schools you created
    <?= Html::a('here', ['school/index'], ['class' => 'alert-link']) ?>.
  </p>
</div>
