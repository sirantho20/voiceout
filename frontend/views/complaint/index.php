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
<div class="row">
    <div class="col-lg-2">
        <?php echo ($model->has_picture == 'Y')?'<img src="/frontend/assets/images/complaints/'.Pictures::getPictureLink($model->complaint_id).'" alt="" class="img-thumbnail" style="width:100%; height:140px; margin-top: 25px;" />':""; ?>
    </div>
    <div class="col-lg-7">
        <h3 class="lead"><?= Company::getCompanyName($model->company_id) ?></h3>
      <p><?= $voh->linkTag($model->complaint) ?></p>
      <footer><cite title="">By: <?= ($model->user_id == '1000010000')?'Anonymous':'' ?> | Date: <?= $model->date_added ?> | Complaint Id:<?= $model->complaint_id ?></cite></footer> 
      <hr class="divider" />
      Share this: 
      <?php 
      if ($model->hashtag != ''){
          echo '<hr class="divider" /> Tags: ' ;
          $tags = explode(',', $model->hashtag);
          foreach ($tags as $tag) {
              echo '<span class="label label-default" style="margin-right:10px;">'.$tag.'</span>';
          }
       }
       ?>
    </div>
    <div class="col-lg-3">
        <p>&nbsp;</p>
        <button class="btn btn-danger btn-block disabled"><span class="badge pull-right">100</span>Escalate</button>
        <button class="btn btn-info btn-block"><span class="badge pull-right">42</span>Follow</button>
        <button class="btn btn-success btn-block">Answer Now</button>
    </div>
</div>