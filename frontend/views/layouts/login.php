<?php

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-us">
    <head>

        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>

    </head>
    <body id="login" class="animated fadeInDown">
<?php $this->beginBody() ?>
        <!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
		<header id="header">
			<!--<span id="logo"></span>-->

			<div id="logo-group">
				<span id="logo"> <img src="img/logo.png" alt="Voiceout Logo"> </span>

				<!-- END AJAX-DROPDOWN -->
			</div>

                    <span id="login-header-space"> <span class="hidden-mobile">Not Registered?</span> <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['user/register']) ?>" class="btn btn-danger">Signup Free</a> </span>

		</header>

        <div id="main" role="main">

            <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-lg-offset-4">
                        <div class="well no-padding">
                            
                            <?= $content ?>

                        </div>

<h5 class="text-center">Or log in using</h5>
    <ul class="list-inline text-center">
            <li>
                    <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
            </li>
            <li>
                    <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                    <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
            </li>
    </ul>
                    </div>
                </div>
            </div>

        </div>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
