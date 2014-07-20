<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use frontend\components\Select2;
use yii\web\JsExpression;
use yii\web\View;
use yii\bootstrap\Modal;

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
$complaintstyle = <<< STYLE
#complaint-complaint {
border:none;
}        
STYLE;
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

    <?php $form = ActiveForm::begin(['id'=>'complaint-form','action'=>  Url::toRoute('/complaint/new'),'options' => ['enctype'=>'multipart/form-data'],'enableAjaxValidation'=>true,'enableClientValidation'=>false]); ?>
    <?= $form->field($model, 'complaint')->textarea(['maxlength' => 250,'style'=>'height: 70px; font-size: 18px; line-height: 1.3em;','placeholder'=>'Please input your complaint here'])->label(false) ?>
    <?php 
    echo $form->field($model, 'company_id')->label(false)->widget(Select2::classname(), [
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
                'content' => '@',
            ],
            'append' => [
                [
                'content' => '<span class="char-counter"></span>',
                ],
                [
                'content' => '<span data-target="#w0" data-toggle="modal" style="cursor:pointer;"><i class="glyphicon   glyphicon-map-marker"></i></span>',
                ],
                [
                'content' => '<span onclick="openWindow()" style="cursor:pointer;"><i class="glyphicon glyphicon-paperclip"></i></span>',
                ],
                [
                'content' => Html::submitButton('<span>Send <i class="glyphicon glyphicon-bullhorn"></i></span>', [
                    'class'=>$model->isNewRecord ? 'btn btn-primary' : 'btn btn-success',
                    'title'=>'',
                    'data-toggle'=>'tooltip'
                ]),
                'asButton'=>true,
                ]
            ]
        ]
    ]);
    ?>
    <?= $form->field($model, 'location')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'photo')->fileInput(['style'=>'display:none;'])->label(false) ?>



    <?php ActiveForm::end(); ?>
  </div>
</div>
</div>
<script>
function openWindow(){
    document.getElementById("complaint-photo").click();
}
</script>
<?php
Modal::begin([
    'header' => '<h4>Add Location</h4>',
    'footer' => Html::button('Add', ['class'=>'btn btn-primary']),
]);

echo 'Say hello...';

Modal::end();
?>