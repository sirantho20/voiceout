<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\widgets\StarRating;
use yii\web\View;

$script = <<< SCRIPT
$('#escalate-level').val('1');
$('#addMessage').on('change',function(){
    if($('#addMessage').is(':checked')){
            $('#showMessage').show();
    }
    else {
            $('#showMessage').hide();
    }
});
$('#complaint_rating').on('rating.change', function(event, value, caption) {
    $("#escalate-level").val(value);
});
SCRIPT;
$this->registerJs($script,View::POS_READY);

?>
<div class="escalate">
<?php 
    echo StarRating::widget([
    'name' => 'complaint_rating',
    'id'=> 'complaint_rating',
    'pluginOptions' => ['size'=>'xs','step'=> 1,'symbol'=>'','showClear'=>false, 'starCaptions' => [ 
                1 => 'Level 1',
                2 => 'Level 2',
                3 => 'Level 3',
                4 => 'Level 4',
                5 => 'Level 5'
            ],
        'starCaptionClasses' => [ 
                1 => 'label label-warning',
                2 => 'label level2',
                3 => 'label level3',
                4 => 'label level4',
                5 => 'label level5'
            ],
        ],
]);
?>
<?php
$form = ActiveForm::begin(['id'=>'complaint-escalate','action'=>  Url::toRoute('/complaint/escalate'),'method'=>'post','options' => ['enctype'=>'multipart/form-data'],'enableAjaxValidation'=>true,'enableClientValidation'=>false]);
echo $form->field($model, 'level')->hiddenInput()->label(false)->error(false);
?>
    <input type="checkbox" id="addMessage" name="addMessage"/> <label for="addMessage">Add a message</label>
    
<?= $form->field($model, 'complaint_id')->hiddenInput(['value'=>$complaintid])->label(false) ?>
    <div style="display:none;" id="showMessage">
<?php $model->message = 'Optional message'; ?>
<?= $form->field($model, 'message')->textarea(['id'=>'escalate-message','onfocus'=>'if(this.value==this.defaultValue){this.value="";}','onblur'=>'if(this.value==""){this.value=this.defaultValue;}','maxlength' => 250,'style'=>'height: 70px; font-size: 18px; line-height: 1.3em;'])->label(false) ?>
    </div>
        <?= $form->field($model, 'company_id')->hiddenInput(['value'=>$companyid])->label(false) ?>
<?= $form->field($model, 'type')->hiddenInput(['value'=>'E'])->label(false) ?>
    
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-right']) ?>
    <?= Html::resetButton('Reset',['class'=>'btn btn-default pull-right','style'=>'margin-right: 15px;']) ?>
</div>
    <?php ActiveForm::end(); ?>
</div><!-- reply -->
