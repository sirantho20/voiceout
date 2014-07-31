<?php
/**
 * @var yii\web\View $this
 */
use frontend\components\Voh;
use app\models\Company;
use app\models\Pictures;
use frontend\extensions\sharelinks\ShareLinks;
use yii\bootstrap\Tabs;
use yii\helpers\Url;

$js = <<< SCRIPT
$('#btn-escalate').on('click',function(){
        $('.nav-tabs a[href="#escalate"]').tab('show');
});
$('#btn-reply').on('click',function(){
        $('.nav-tabs a[href="#reply"]').tab('show');
});
SCRIPT;

$this->registerJs($js,  yii\web\View::POS_READY);

$voh = new Voh();
$this->title = Company::getCompanyName($model->company_id).' - '.substr($model->complaint,0,100);
?>
<div style="background: #f7f9fa; padding-top: 18px; padding-bottom: 25px; margin-top: -18px;">
<div class="container">
<div class="row">
    <div class="col-sm-2">
        <?php echo ($model->has_picture == 'Y')?'<img src="/frontend/assets/images/complaints/'.Pictures::getPictureLink($model->complaint_id).'" alt="" class="img-thumbnail" style="width:100%; height:140px; margin-top: 25px;" />':"<span style='margin-top:22px; width:100%; height: 140px; background: #fafafa; border: 1px solid #f5f5f5;display:block;'><i style='display:block; font-size: 60px; color: #c7c7c7; text-align:center; margin-top: 35px;' class='glyphicon glyphicon-camera'></i></span>"; ?>
    </div>
    <div class="col-sm-7">
        <h3 class="lead"><?= Company::getCompanyName($model->company_id) ?></h3>
      <p><?= $voh->linkTag($model->complaint) ?></p>
      <footer><cite title="">By: <?= ($model->user_id == '1000010000')?'Anonymous':'' ?> | Date: <?= $model->date_added ?> | Complaint Id:<?= $model->complaint_id ?></cite></footer> 
      <hr class="divider" />
      <?php
        echo ShareLinks::widget();
      ?>
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
    <div class="col-sm-3">
        <p>&nbsp;</p>
        <a href="#escalate" id="btn-escalate" class="btn btn-danger btn-block"><span class="badge pull-right"><?= Voh::EscalateCounter($model->complaint_id) ?></span>Escalate</a>
        <a href="<?= Url::toRoute('/complaint/follow?complaint_id='.$model->complaint_id.'&company_id='.$model->company_id) ?>" class="btn btn-info btn-block"><span class="badge pull-right"><?= Voh::FollowCounter($model->complaint_id) ?></span>Follow</a>
        <a href="#reply" id="btn-reply" class="btn btn-success btn-block">Answer Now</a>
    </div>
</div><!-- @end of row -->
</div><!-- @end of container -->
</div><!-- @end complaint -->
<div class="container">
<div class="col-sm-9" id="complaint-reply">
<div id="replies">
<?php echo Voh::ComplaintTimeline($model->complaint_id); ?>
</div><!-- @end of replies -->
<div class="comment-box clearfix">

<?php 
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Reply',
            'content'=> \yii\base\View::render('reply',['model'=>$reply,'complaintid'=>$model->complaint_id,'companyid'=>$model->company_id,'type'=>'R']),
            'options' => ['id' => 'reply'],
            'active' => true
        ],
        [
            'label' => 'Escalate',
            'options' => ['id' => 'escalate'],
            'content' => \yii\base\View::render('escalate',['model'=>$escalate,'complaintid'=>$model->complaint_id,'companyid'=>$model->company_id,'type'=>'E']),
        ],
    ],
]);
?>
</div><!-- comment box -->
</div>
<div class="col-sm-3 complaint-sidebar">
    
    <div class="panel panel-default">
        <div class="panel-heading">Related Complaints</div>
        <div class="panel-body">
            No related complaint
        </div>
    </div><!-- @end of sidebar panel -->
    
    <div class="discussion-sidebar-item">
        <h3 class="discussion-sidebar-heading">Alternative Providers</h3>
        <span class="text-muted">No alternative service provider as of yet</span>
    </div><!-- end of discussion sidbar item -->
</div>
</div>