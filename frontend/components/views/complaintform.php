<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\models\Complaint $model
 * @var yii\widgets\ActiveForm $form
 */

/*******
* View
******/
 
// The controller action that will render the list
$url = \yii\helpers\Url::toRoute(['/company/getcompany']);
 
// Script to initialize the selection based on the value of the select2 element
$initScript = <<< SCRIPT
function (element, callback) {
var id=\$(element).val();
if (id !== "") {
\$.ajax("{$url}?id=" + id, {
dataType: "json"
}).done(function(data) { callback(data.results);});
}
}
SCRIPT;
$generalscript = <<< GENERAL
$.fn.extend({
limiter: function(limit, elem){
$(this).on("keyup focus lostfocus", function() {
setCount(this, elem);
});
function setCount(src, elem) {
var chars = src.value.length;
if (chars > limit) {
src.value = src.value.substr(0, limit);
chars = limit;
}
elem.html( limit - chars );
}
setCount($(this)[0], elem);
}
});
//Character count
var elem = $('.char-counter');
$("#complaint-complaint").limiter(250, elem);              
GENERAL;

$this->registerJs($generalscript,View::POS_READY);
?>

<div class="panel panel-default">
<?php if (isset($title) && !empty($title)): ?>
<div class="panel-heading"><?=$title; ?></div>
<?php endif; ?>
<div class="panel-body">
<div class="complaint-form">

    <?php $form = ActiveForm::begin(['id'=>'complaint-form','action'=>  Url::toRoute('/complaint/new'),'enableAjaxValidation'=>true,'enableClientValidation'=>false]); ?>

    <?php
    // The widget
    echo $form->field($model, 'company_id')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Select a company ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 2,
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(term,page) { return {search:term}; }'),
                'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
            ],
            'initSelection' => new JsExpression($initScript)
        ],
        'addon' => [
            'prepend' => [
                'content' => '<i class="glyphicon glyphicon-search"></i>'
            ],
            'append' => [
                'content' => Html::button('<i class="glyphicon glyphicon-map-marker"></i>', [
                    'class'=>'btn btn-primary',
                    'title'=>'Mark on map',
                    'data-toggle'=>'tooltip'
                ]),
                'asButton'=>true,
            ]
        ]
    ]);
    ?>

    <?= $form->field($model, 'complaint',['options'=>['label'=>'n']])->textInput(['maxlength' => 255]) ?>
    <span class="char-counter"></span>
    <?= $form->field($model, 'rating')->textInput() ?>
    <?= $form->field($model, 'is_private')->textInput(['maxlength' => 1]) ?>
    <?= $form->field($model, 'location')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
</div>
