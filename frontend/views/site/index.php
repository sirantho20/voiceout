<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'Voice Out - Better Customer Service';
use frontend\components\ComplaintWidget;
use app\models\Company;
use app\models\Pictures;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\components\Voh;
?>
<div class="site-index">
<div class="container">
    <div class="" style="text-align: center; margin-top: 50px; margin-bottom: 35px;">
        <h2>You deserver better customer service</h2>

        <p class="lead">Don’t settle for poor customer service. You deserve better and we are here to help you get just that. 
Report below</p>
    </div>
        <?= ComplaintWidget::widget(['mode'=>'advanced','title'=>'']); ?>
    
</div><!-- @end of container -->

    <div class="body-content">
        <div class="container">
            <div class="row" style="padding-bottom: 20px;">
            <div class="col-sm-4">
                <h2>Industry</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-sm-4">
                <h2>Companies</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-sm-4">
                <h2>Keywords</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
        </div><!-- @end of container -->
<div class="frc-section">
<div class="fmenu">
    <div class="container">
        <div class="cmenu">
            <ul>
                <li class="active"><a href="#">Recent Complaints</a></li>
                <li><a href="#" >Popular Complaints</a></li>
                <li><a href="#">Recently Answered</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    

            <div class="row">
            <?php 
                $complaints = frontend\controllers\ComplaintController::ComplaintList();
                if (is_array($complaints)){
                    foreach($complaints as $complaint)
                    {
            ?>
                    <div class="col-sm-4 frc">
                     <div class="frc-item">
                        <div class="frc-img">
                            <?php echo ($complaint->has_picture == 'Y')?'<img src="/frontend/assets/images/complaints/'.Pictures::getPictureLink($complaint->complaint_id).'" alt="" width="100%" />':"<span style='width:100%; display:block;'><i style='display:block; font-size: 30px; color: #c7c7c7; text-align:center; margin-top: 15px;' class='glyphicon glyphicon-camera'></i></span>"; ?>
                        </div>
                         <div class="ftext">
                         <div class="description">
                            <h4 class=""><?= "<a href='".Url::toRoute("/complaint/".$complaint->slug)."'>".Company::getCompanyName($complaint->company_id)."</a>" ?></h4>  
                             <?php echo \frontend\components\Voh::truncateByWord(Html::encode($complaint->complaint), 140, '...') ;  ?>
                            <br />
                            <span class="">By: Anonymous</span><span class="bullet"> • </span><span class="">2 minutes ago</span>
                         </div>
                             <a href="<?= Url::toRoute("/complaint/".$complaint->slug) ?>" class="btn btn-default btn-xs pull-left" style="background:#f7f9fa;">View</a>
                         </div>
                     <div class="attributes">   
                         <span class=""><i class="glyphicon glyphicon-heart-empty"></i> <?= Voh::FollowCounter($complaint->complaint_id) ?></span><br />
                         <span class=""><i class="glyphicon glyphicon-comment"></i> <?= Voh::ReplyCounter($complaint->complaint_id) ?></span><br />
                         <span class=""><i class="glyphicon glyphicon-fire"></i> <?= Voh::EscalateCounter($complaint->complaint_id) ?></span>
                     </div>
                    </div>
                    </div>
            <?php
                    }
                }
            ?>

            </div>
 </div><!-- @end of container -->
</div><!-- @end of frc section -->
 <div id="social" class="page-block">
    	<div class="container">
        <div class="row social-header">
          <h2>Find us on social networks</h2>
          <span>Be social :)</span>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="social-networks">
              <a title="" target="_blank" href="https://www.facebook.com/ivoiceout" class="fa fa-facebook tooltipped" data-original-title="Facebook"></a>
              <a title="" href="javascript:;" class="fa fa-instagram tooltipped" data-original-title="Instagram"></a>
              <a title="" target="_blank" href="https://www.twitter.com/ivoiceout" class="fa fa-twitter tooltipped" data-original-title="Twitter"></a>
              <a title="" target="_blank" href="" class="fa fa-google-plus tooltipped" data-original-title="Google+"></a>
              <a title="" target="_blank" href="https://www.youtube.com/user/voiceout" class="fa fa-youtube tooltipped" data-original-title="Youtube"></a>
            </div>
          </div>
        </div>
      </div>
    </div><!-- @end of social -->
    <div class="pre-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Voice Out Office</h4>
                    <p>
                        Goil station on the Madina new road. Action school road<br />
P: 24/7 customer support: 030-254-2846<br />
M: 024-306-3870 / 024-430-4946 <br />
E: info@ivoiceout.com
                    </p>
                </div>
                <div class="col-sm-4">
                    <h4>Customer Support</h4>
                    <ul>
                        <li>FAQs</li>
                        <li>How can I track my complaint</li>
                        <li>We are a small business. Can we use voice out</li>
                        <li>Will this always be free for the public</li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h4>Subscribe to updates</h4>
                    <p>Receive free tips on how to offer better customer service. Subscribe below</p>
                    <div class="input-group">
                        <input type="text" placeholder="Email address" class="form-control">
                        <span class="input-group-btn">
                          <button class="btn btn-success" type="button">Subscribe!</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </div>
    </div>
</div><!-- @end of body content -->
</div><!-- @end of site content -->