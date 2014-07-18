<?php
/**
 * @var yii\web\View $this
 */
use frontend\components\Voh;
use app\models\Company;
use app\models\Pictures;
$voh = new Voh();
$this->title = Company::getCompanyName($model->company_id).' - '.substr($model->complaint,0,100);
?>
<h1 class="lead">Complaint Number: <?= $model->complaint_id ?></h1>

<div class="col-lg-9">
    <h3 class="lead">Company: <?= Company::getCompanyName($model->company_id) ?></h3>
<blockquote>
  <p><?= $voh->linkTag($model->complaint) ?></p>
  <footer>Someone famous in <cite title=""><?= $model->user_id ?></cite></footer>
</blockquote>  
</div>
<div class="col-lg-3">
    <?php echo ($model->has_picture == 'Y')?"<img src='".Yii::$app->basePath.'/assets/images/complaints/'.Pictures::getPictureLink($model->complaint_id)."' alt='' />":""; ?>
</div>