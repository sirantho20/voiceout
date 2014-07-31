<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Reply */
/* @var $form ActiveForm */
?>

<div class="reply">

    <?php $form = ActiveForm::begin(['id'=>'complaint-reply','action'=>  Url::toRoute('/complaint/reply'),'method'=>'post','options' => ['enctype'=>'multipart/form-data'],'enableAjaxValidation'=>false,'enableClientValidation'=>true]); ?>

        <?= $form->field($model, 'complaint_id')->hiddenInput(['value'=>$complaintid])->label(false) ?>
        <?= $form->field($model, 'message')->textarea(['maxlength' => 250,'style'=>'height: 70px; font-size: 18px; line-height: 1.3em;','placeholder'=>'Please input your reply here'])->label(false) ?>
        <?= $form->field($model, 'company_id')->hiddenInput(['value'=>$companyid])->label(false) ?>
        <?= $form->field($model, 'type')->hiddenInput(['value'=>'R'])->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- reply -->