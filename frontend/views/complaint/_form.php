<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Complaint $model
 * @var yii\widgets\ActiveForm $form
 */
?>

  

<div class="panel panel-default">
<?php if (isset($title) && !empty($title)): ?>
<div class="panel-heading"><?=$title; ?></div>
<?php endif; ?>
<div class="panel-body">
<div class="complaint-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'complaint_id')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'company_id')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'complaint')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_updated')->textInput() ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'cookie_id')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'hashtag')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'is_private')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'published')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'has_picture')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'has_audio')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
</div>
