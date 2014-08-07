<?php
use yii\helpers\Html;
use frontend\components\Voh;
use yii\helpers\Url;
?>
<div class="company-top">
    <div class="container">
        <div class="col-sm-9">
        <div class="pull-left company-img"><img src="" width="100" height="100" /></div>
        <div class="pull-left">
            <h3 class="title"><?=Html::encode($model->company_name) ?><br /></h3>
                <span class="desc"><?=Html::encode($model->description) ?></span><br />
                <span><i class="glyphicon glyphicon-globe"></i> www.mtnworld.com</span><br />
                <span><i class="glyphicon glyphicon-phone"></i> 0243063870</span>
        </div>
        </div><!-- @end of col 9 -->
        <div class="col-sm-3">
            <div class="" style="padding-top:5px;">
                <a class="btn btn-default btn-block">Raise ticket</a>
                <a href="<?=Url::toRoute('/company/follow?id='.$model->company_id) ?>" class="btn btn-primary btn-block">Follow</a>
            </div>
        </div><!-- @end of col 3 -->
    </div>
</div>
<div class="company-menu">
    <div class="container">
        <div class="cmenu pull-left">
            <ul>
                <li class="active"><?php
    echo Html::a('Complaints','company', [
    'onclick'=>"
     $.ajax({
    type     :'GET',
    cache    : false,
    url  : '".Url::toRoute('/company/'.$model->slug)."',
    success  : function(response) {
        $('#pjax').html(response);
    }
    });return false;",
                ]);
    ?></li>
                <li><a href="#" >Activity</a></li>
                <li><?php
     echo Html::a('Followers <span class="badge">'.Voh::FollowCompanyCounter($model->company_id).'</span>','company/followers', [
    'onclick'=>"
     $.ajax({
    type     :'GET',
    cache    : false,
    url  : '".Url::toRoute('/company/followers')."?id=".$model->company_id."',
    success  : function(response) {
        $('#pjax').html(response);
    }
    });return false;",
                ]);
                ?></li>
                <li><a href="#">Raise Ticket</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="company-complaint" class="container">
<div class="col-sm-9">
<div id="pjax">
   
<div class="company-complaints">
            
 <?php foreach ($complaint as $item) : ?>
            <div class="complaint-item">
                <span class="complaint-item-date">
                    <span><i class="glyphicon glyphicon-comment"></i> <?= Voh::ReplyCounter($item->complaint_id) ?></span>
                    <span class="clearfix">Feb 22</span>
                </span>
                <span class="complaint-item-image">
                    <img height="35" width="100%" src="/frontend/assets/images/user.png" alt="" /><br />
                    <?= $item->user_id ?>
                </span>
                <span class="complaint-item-body">
                    <?php echo Voh::truncateByWord(Html::encode($item->complaint), 160, '...') ;  ?>
                </span>
                <span class="complaint-item-action">
                    <a href="<?= Url::toRoute("/complaint/".$item->slug) ?>#reply" class="btn btn-default">Reply</a>
                    <a href="<?= Url::toRoute("/complaint/".$item->slug) ?>" class="btn btn-primary">View</a>
                </span>
            </div><!-- @end of item -->
<?php endforeach; ?>
        </div>
    
</div><!-- @end of pjax -->
</div><!-- end of left side -->
<div class="col-sm-3 company-sidebar">
      
</div><!-- @end of right side -->
</div><!-- @end of container -->