<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\CompanyUsers $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="company-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email_address')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => 45]); ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 45]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
print_r($model->getScenario());
?>
