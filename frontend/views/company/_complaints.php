<?php
use yii\helpers\Html;
use frontend\components\Voh;
use yii\helpers\Url;
?>
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
