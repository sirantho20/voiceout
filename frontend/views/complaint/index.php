<?php
/**
 * @var yii\web\View $this
 */
use frontend\components\Voh;
$voh = new Voh();
$this->title = $model->company_id.  substr($model->complaint_id,0,100);
?>
<h1 class="lead">Complaint Number: <?= $model->complaint_id ?></h1>

<div class="">
    <h3 class="lead">Company: <?= $model->company_id ?></h3>
<blockquote>
  <p><?= $voh->linkTag($model->complaint) ?></p>
  <footer>Someone famous in <cite title=""><?= $model->user_id ?></cite></footer>
</blockquote>  
</div>
