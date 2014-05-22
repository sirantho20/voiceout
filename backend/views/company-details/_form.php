<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/**
 * @var yii\web\View $this
 * @var backend\models\CompanyDetails $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="company-details-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data', 'method'=>'POST']]); ?>
    
    <?= $form->field($model, 'email_address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'address_line_1')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'address_line_2')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'logo_pic')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],'pluginOptions' => ['showRemove' => false,]]) ?>

    <?= $form->field($model, 'wallpaper_pic')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],'pluginOptions' => ['showRemove' => false,]]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
print_r($model->getErrors());

