<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplaintSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complaint-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'complaint_id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'cookie_id') ?>

    <?php // echo $form->field($model, 'complaint') ?>

    <?php // echo $form->field($model, 'hashtag') ?>

    <?php // echo $form->field($model, 'is_private') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'date_added') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'has_picture') ?>

    <?php // echo $form->field($model, 'has_audio') ?>

    <?php // echo $form->field($model, 'read_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
