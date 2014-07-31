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
$("[data-toggle='tooltip']").tooltip(); 
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
$map = <<< MAP
$('#add-location').click(function () {
        $.getScript("http://maps.google.com/maps/api/js?sensor=false&callback=initialize");
        $("#w0").on("shown.bs.modal", function () {
            google.maps.event.trigger(map, "resize");
        });
});   
MAP;
$this->registerJs($generalscript,View::POS_READY);
$this->registerJs($map,View::POS_READY);
$this->registerCssFile('/frontend/assets/fontawesome/css/font-awesome.min.css');
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
                'content' => '<span id="add-location" data-target="#w0" data-toggle="modal" style="cursor:pointer;"><i class="glyphicon   glyphicon-map-marker" data-toggle="tooltip" title="Add location"></i></span>',
                ],
                [
                'content' => '<span onclick="openWindow()" style="cursor:pointer;"><i class="glyphicon glyphicon-paperclip" data-toggle="tooltip" title="Add photo"></i></span>',
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
<?php
Modal::begin([
    'header' => '<h4>Add Location (Drag marker to select)</h4>',
    'footer' => Html::button('Add', ['class'=>'btn btn-primary','data-dismiss'=>'modal','id'=>'btnAddLocation']).Html::button('Clear Location',['onclick'=>'js:$("#complaint-location").val("")','class'=>'btn btn-primary']).Html::button('close',['data-dismiss'=>'modal','class'=>'btn btn-primary']),
]);

echo '<div id="map_canvas" style="width: 100%; height: 250px"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p><center><h4><span class="spinner"><i class="fa fa-spinner fa-spin"></i></span> Loading...</h4></center><p></div>';

Modal::end();
?>
<script>
function openWindow(){
    document.getElementById("complaint-photo").click();
}

var map;
var initialLocation;
var browserSupportFlag =  new Boolean();
var accra;
var marker;
function initialize() {
  accra = new google.maps.LatLng(5.5912087,-0.1797295);
  var myOptions = {
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  var isFirefox = typeof InstallTrigger !== 'undefined';
  if (!isFirefox){
  // Try W3C Geolocation (Preferred)
  if(navigator.geolocation) {
    browserSupportFlag = true;
    navigator.geolocation.getCurrentPosition(function(position) {
      initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        map.setCenter(initialLocation);
        marker = new google.maps.Marker({
            map:map,
            draggable:true,
            animation: google.maps.Animation.DROP,
            position: initialLocation
        });
    google.maps.event.addListener(marker, 'click', toggleBounce);
    google.maps.event.addListener(marker,'dragend',function(event) {
    document.getElementById('complaint-location').value = event.latLng.lat()+','+event.latLng.lng();
    });

    }, function() {
      handleNoGeolocation(browserSupportFlag);
    },{ enableHighAccuracy: true, timeout: 100, maximumAge: 0 }
);
  }
  // Browser doesn't support Geolocation
  else {
    browserSupportFlag = false;
    handleNoGeolocation(browserSupportFlag);
  }
}
else
{
    map.setCenter(accra);
    marker = new google.maps.Marker({
            map:map,
            draggable:true,
            animation: google.maps.Animation.DROP,
            position: accra
    });
    google.maps.event.addListener(marker, 'click', toggleBounce);
    google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('complaint-location').value = event.latLng.lat()+','+event.latLng.lng();
    });
    
}

  function handleNoGeolocation(errorFlag) {
    if (errorFlag == true) {
      initialLocation = accra;
      
    } else {
      initialLocation = accra;
    }
    map.setCenter(initialLocation);
    marker = new google.maps.Marker({
            map:map,
            draggable:true,
            animation: google.maps.Animation.DROP,
            position: initialLocation
    });
    google.maps.event.addListener(marker, 'click', toggleBounce);
    google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('complaint-location').value = event.latLng.lat()+','+event.latLng.lng();
    });
  }
  
  function toggleBounce() {

  if (marker.getAnimation() != null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

}
</script>