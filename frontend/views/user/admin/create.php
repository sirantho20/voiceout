<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 */
Yii::$app->controller->layout = '@app/views/layouts/adminMain';
$this->title = Yii::t('user', 'Create a user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- NEW COL START -->
<article class="col-sm-12 col-md-8 col-lg-8" style="margin-bottom: 15px;">
<div class="row">
<div class="alert alert-info">
            <?= Yii::t('user', 'Password and username will be sent to user by email') ?>.
            <?= Yii::t('user', 'If you want password to be generated automatically leave its field empty') ?>.
        </div>
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

       <header><span class="widget-icon"> <i class="fa fa-user"></i> </span><h2>Create User</h2></header>
     
        <div>
                <div class="jarviswidget-editbox">

                </div>

                <div class="widget-body no-padding">
<div class="sitedetails-form">
        <?php $form = ActiveForm::begin([
                     'options'=>['class'=>'smart-form'],
                     'fieldConfig'=>['labelOptions'=>['class'=>'label', 'style'=>'font-weight:bold;'],'options'=>['tag'=>'section']]
                    ]); ?>
    <fieldset>
        <?= $form->field($model, 'username')->textInput(['maxlength' => 25, 'autofocus' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'role')->textInput(['maxlength' => 255]) ?>
    </fieldset>
    <footer>
            <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-success']) ?>
    </footer>

        <?php ActiveForm::end(); ?>
</div>
                </div>
        </div>
</div>
</article>
</div>
