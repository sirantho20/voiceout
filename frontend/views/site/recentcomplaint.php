<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
            <?php 
                $complaints = frontend\controllers\ComplaintController::ComplaintList();
                if (is_array($complaints)){
                    foreach($complaints as $complaint)
                    {
            ?>
                    <div class="col-sm-4 front-complaint" style="height: 320px;">
                        <div style="height: 140px; overflow: hidden;">
                            <?php echo ($complaint->has_picture == 'Y')?'<img src="/frontend/assets/images/complaints/'.Pictures::getPictureLink($complaint->complaint_id).'" alt="" width="100%" />':"<span style='width:100%; height: 140px; background: #fafafa; border: 1px solid #f5f5f5;display:block;'><i style='display:block; font-size: 60px; color: #c7c7c7; text-align:center; margin-top: 35px;' class='glyphicon glyphicon-camera'></i></span>"; ?>
                        </div>
                        <div class="fhead"><h4 class=""><?= "<a href='".Url::toRoute("/complaint/".$complaint->slug)."'>".Company::getCompanyName($complaint->company_id)."</a>" ?></h4>
                            <div class="meta-info"><span class="">By: Anonymous</span><span class="bullet"> • </span><span class="">2 minutes ago</span></div>
                         </div>
                        <p class="description"><?php echo \frontend\components\Voh::truncateByWord(Html::encode($complaint->complaint), 160, '...') ;  ?><p>
                        <div class="attributes"><a href="<?= Url::toRoute("/complaint/".$complaint->slug) ?>" class="btn btn-default btn-xs pull-left">View</a> <span class="pull-right"><i class="glyphicon glyphicon-heart-empty"></i> <?= Voh::FollowCounter($complaint->complaint_id) ?>&nbsp; <span><span class="pull-right"><i class="glyphicon glyphicon-comment"></i> <?= Voh::ReplyCounter($complaint->complaint_id) ?>&nbsp; <span><span class="pull-right"><i class="glyphicon glyphicon-fire"></i> <?= Voh::EscalateCounter($complaint->complaint_id) ?></span></div>
                    </div>
            <?php
                    }
                }
            ?>

            </div>
