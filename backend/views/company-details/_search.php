<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\CompanyDetailsSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="company-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'email_address') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?= $form->field($model, 'address_line_1') ?>

    <?php // echo $form->field($model, 'address_line_2') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'logo_pic') ?>

    <?php // echo $form->field($model, 'wallpaper_pic') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
