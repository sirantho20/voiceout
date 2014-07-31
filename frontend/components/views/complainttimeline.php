<?php
use app\models\Reply;
?>
<div class="discussion-timeline">
<?php 
foreach ($timeline as $item){
    switch ($item->action_type){
        case 'R' :
            $reply = Reply::find()->where(['id'=>$item->action_id])->one();
?>
 <div class="timeline-comment-wrapper">
      <a href="/<?=$reply->user_id ?>"><img width="48" height="48" src="/frontend/assets/images/user.png" class="timeline-comment-avatar" alt=""></a> 
    <div class="timeline-comment ">
    <div class="comment">
      <div class="timeline-comment-header ">
        <span class="timeline-comment-label">Staff</span>
        <div class="timeline-comment-header-text">
            <strong><a class="author" href="/dilip-vishwa"><?=$reply->user_id ?></a></strong> commented on <?= date('M d H:i',  strtotime($reply->date_addded)) ?>
        </div>
      </div><!-- @end of timeline comment header -->
      <div class="comment-content">
          <div class="edit-comment-hide">
            <div class="comment-body">
                <p><?= $reply->message ?></p>
            </div>
          </div>
      </div><!-- @end of comment-content -->
  </div><!-- @end of comment -->
  </div><!-- @end of timeline comment -->
  </div><!-- @end of timeline comment wrapper -->
<?php
        break;  
        case 'E' :
            $reply = Reply::find()->where(['id'=>$item->action_id])->one();
?>
  <div class="discussion-item discussion-item-escalate">
    <div class="discussion-item-header">
      <span class="octicon octicon-circle-slash discussion-item-icon">E</span>
      <img width="16" height="16" src="/frontend/assets/images/user.png" class="avatar" alt="">
      <a class="author" href="/<?=$reply->user_id ?>"><?=$reply->user_id ?></a>
      escalated this complaint on <?= date('M d H:i',  strtotime($reply->date_addded)) ?>
      <?php if ($reply->message != 'Optional message'): ?><div class="commit-desc"><pre><?= $reply->message ?></pre></div><?php endif; ?>
    </div>
  </div><!-- @end of discussion item -->
  <?php
        break;
        case 'F' :
            $follow = app\models\ComplaintFollowing::find()->where(['id'=>$item->action_id])->one();
 ?>
        <div class="discussion-item discussion-item-follow">
    <div class="discussion-item-header">
      <span class="octicon octicon-circle-slash discussion-item-icon">F</span>
      <img width="16" height="16" src="/frontend/assets/images/user.png" class="avatar" alt="">
      <a class="author" href="/klimov-paul"><?=$follow->user_id ?></a>
      is following this complaint on <?= date('M d H:i',  strtotime($follow->date_added)) ?>
    </div>
  </div><!-- @end of discussion item -->
  <?php
        break;
        case 'B' :
            
        break;
    }
}
?>
<div class="closed-banner"></div>
</div><!-- @end of discussion timeline -->

