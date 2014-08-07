		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
                <?php
                use yii\helpers\Url;
                ?>
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					<a href="#" id="show-shortcut">
						<span>
							<?= Yii::$app->user->identity->company_id ?>
						</span></i>
					</a> 
					
				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->

				<ul>
                                    <li>
                                            <a href="<?= Url::to(['dashboard/index']) ?>">
                                                    <i class="fa fa-lg fa-fw fa-coffee"></i> 
                                                    <span class="menu-item-parent"> Dashboard</span>
                                                </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Sites"><i class="fa fa-lg fa-fw fa-comments-o"></i> <span class="menu-item-parent">Complaints</span></a>
                                        <ul>
                                            <li>
                                                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['complaint/index']) ?>" title="Manage Sites">Inbox</a>
                                            </li>
                                        </ul>
                                    </li>
					<li class="">
                                            <a href="#" title="Manage Gensets"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Users</span></a>
                                            <ul>
                                                <li>
                                                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['user/admin']) ?>">Manage Users</a>
                                                </li>
                                            </ul>
					</li>
					<li>
                                            <a href="#">
                                                    <i class="fa fa-lg fa-fw fa-credit-card"></i> 
                                                    <span class="menu-item-parent">Account</span>
                                                </a>
                                            <ul>
                                                <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['company-details/update','company_id'=>  Yii::$app->user->identity->company_id]) ?>">Details</a></li>
                                                <li><a href="#">Subscription Plan</a></li>
                                            </ul>
					</li>
                                        <li>
                                            <a href="#"><i class="fa fa-lg fa-fw fa-suitcase"></i><span class="menu-item-parent">Super</span></a>
                                            <ul>
                                                <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['company/index']) ?>">Manage Companies</a></li>
                                            </ul>
                                        </li>
			
				</ul>
			</nav>
			<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->