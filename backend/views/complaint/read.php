<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\web\View;
use yii\base\Formatter;
?>


<h2 class="email-open-header">
	Re: Timelogs of last client <span class="label txt-color-white">inbox</span>
	<a href="javascript:void(0);" rel="tooltip" data-placement="left" data-original-title="Print" class="txt-color-darken pull-right"><i class="fa fa-print"></i></a>	
</h2>

<div class="inbox-info-bar">
	<div class="row">
		<div class="col-sm-9">
			
			<strong><?= $username ?>'s</strong>
                        <span class="hidden-mobile"> complaint about <strong><?= $company->company_name ?></strong> on <i><?= (new Formatter())->asDatetime($complaint->date_added,"M. j, Y g:i a") ?></i></span> 
		</div>
		<div class="col-sm-3 text-right">
			
			<div class="btn-group text-left">
				<button class="btn btn-primary btn-sm replythis">
					<i class="fa fa-reply"></i> Reply
				</button>
				<button class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="javascript:void(0);" class="replythis"><i class="fa fa-reply"></i> Reply</a>
					</li>
					<li>
						<a href="javascript:void(0);" class="replythis"><i class="fa fa-mail-forward"></i> Forward</a>
					</li>
					<li>
						<a href="javascript:void(0);"><i class="fa fa-print"></i> Print</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="javascript:void(0);"><i class="fa fa-ban"></i> Mark as spam!</a>
					</li>
					<li>
						<a href="javascript:void(0);"><i class="fa fa-trash-o"></i> Delete forever</a>
					</li>
				</ul>
			</div>

		</div>
	</div>
</div>

<div class="inbox-message">
	<p>
            <?= $complaint->complaint; ?>
        </p>
	
	<br>
	<br>
	Thanks,<br> 
	<strong><?= $username ?></strong>
	<br>
	<br>
	<small>
		

	</small>
	<br>	
</div>

<div class="inbox-download">
	2 attachment(s) — <a href="javascript:void(0);"> Download all attachments</a> 
	
	<ul class="inbox-download-list">
		<li>
			<div class="well well-sm">
				<span>
					<img src="img/demo/sample.jpg">
				</span>
				<br>
				<strong>rocketlaunch.jpg</strong> 
				<br>
				400 kb 
				<br> 
				<a href="javascript:void(0);"> Download</a>  | <a href="javascript:void(0);"> View</a>
			</div>
		</li>
		<li>
			<div class="well well-sm">
				<span>
					<i class="fa fa-file"></i>
				</span>
				
				<br>
				<strong>timelogs.xsl</strong> 
				<br>
				1.3 mb 
				<br> 
				<a href="javascript:void(0);"> Download</a> | <a href="javascript:void(0);"> Share</a>
			</div>
		</li>
	</ul>
</div>

<div class="email-infobox">

	<div class="well well-sm well-light">
		<h5>Related Invoice</h5>
		<ul class="list-unstyled success">
			<li>
				<i class="fa fa-file fa-fw text-success"></i><a href="javascript:void(0);"> #4831</a> - Paid something small to me the other time
			</li>
			<li>
				<i class="fa fa-file fa-fw text-danger"></i><a href="javascript:void(0);"><strong> #4835 - Unpaid</strong></a>
			</li>
		</ul>


	</div>

	<div class="well well-sm well-light">
		<h5>Upcoming Meetings</h5>
		
		<p>
			<span class="label label-success"><i class="fa fa-check"></i> <strike>Agenda Review @ 10 AM</strike> </span> this is something else
		</p>

		<p>
			<span class="label label-primary"><i class="fa fa-clock-o"></i> Client Meeting @ 2:30 PM</span>
		</p>

		<p>
			<span class="label label-warning"><i class="fa fa-clock-o"></i> Salary Review @ 4:00 PM</span>
		</p>		
	</div>	

	<ul class="list-inline">
		<li><img src="img/avatars/5.png" alt="me" width="30px"></li>
		<li><img src="img/avatars/3.png" alt="me" width="30px"></li>
		<li><img src="img/avatars/sunny.png" alt="me" width="30px"></li>
		<li><a href="javascript:void(0);">1 more</a></li>
	</ul> -->

</div>

<script type="text/javascript">
	
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	//pageSetUp();
	
	// PAGE RELATED SCRIPTS
	
	$(".table-wrap [rel=tooltip]").tooltip();

	$(".replythis").click(function(){
		loadURL("ajax/email-reply.html"+$(this).attr('id'), $('#inbox-content > .table-wrap'));
	})
	
</script>
