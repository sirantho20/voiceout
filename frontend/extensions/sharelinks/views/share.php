<?php
use frontend\extensions\sharelinks\ShareLinks;
use yii\helpers\Html;
$this->registerCssFile('/frontend/assets/css/social-buttons.css');
$this->registerCssFile('/frontend/assets/fontawesome/css/font-awesome.min.css');
?>
<div class="socialShareBlock">Share this:
	<?php echo
	Html::a('<i class="fa fa-facebook"></i> | Facebook', $this->context->shareUrl(ShareLinks::SOCIAL_FACEBOOK),
		['title' => 'Share to Facebook','class'=>'btn btn-xs btn-facebook']) ?>
	<?=
	Html::a('<i class="fa fa-twitter"></i> | Twitter', $this->context->shareUrl(ShareLinks::SOCIAL_TWITTER),
		['title' => 'Share to Twitter','class'=>'btn btn-xs btn-twitter']) ?>
	<?=
	Html::a('<i class="fa fa-linkedin"></i> | LinkedIn', $this->context->shareUrl(ShareLinks::SOCIAL_LINKEDIN),
		['title' => 'Share to LinkedIn','class'=>'btn btn-xs btn-linkedin']) ?>
	<?=
	Html::a('<i class="fa fa-google-plus"></i> | Google Plus', $this->context->shareUrl(ShareLinks::SOCIAL_GPLUS),
		['title' => 'Share to Google Plus','class'=>'btn btn-xs btn-google-plus']) ?>
	
</div>