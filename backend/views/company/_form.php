<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\Company $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'industry_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Industry::find()->all(), 'id', 'industry_name')) ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\Category::find()->all(), 'id', 'category_name')) ?>

    <?= $form->field($model, 'license_package')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\Packages::find()->all(), 'id', 'package_name')) ?>

    <?= $form->field($model, 'confirmed')->dropDownList(['y'=>'Yes','n'=>'No']) ?>

    <?= $form->field($model, 'is_registered')->dropDownList(['y'=>'Yes','n'=>'No']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
