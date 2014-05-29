<?php

use yii\widgets\ActiveForm;
use yii\web\UrlManager;

/**
 * @var yii\web\View $this
 * @var backend\models\Company $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="company-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'password-reset-form',
        'method' => 'POST',
        'action' => (new UrlManager())->createUrl(['company/cpassword'])
    ]); ?>

    <?= $form->field(new backend\models\passwordChangeForm(), 'password')->textInput(['maxlength' => 12]) ?>

    <?php ActiveForm::end(); ?>

</div>
