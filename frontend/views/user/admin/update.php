<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 */
Yii::$app->controller->layout = '@app/views/layouts/adminMain';
$this->title = Yii::t('user', 'Update user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><i class="glyphicon glyphicon-user"></i> <?= Html::encode($model->username) ?>
    <?php if (!$model->getIsConfirmed()): ?>
        <?= Html::a(Yii::t('user', 'Confirm'), ['confirm', 'id' => $model->id], ['class' => 'btn btn-success btn-xs', 'data-method' => 'post']) ?>
    <?php endif; ?>
    <?php if (!is_null($model->recovery_token)): ?>
        <?= Html::a(Yii::t('user', 'Delete recovery tokens'), ['delete-tokens', 'id' => $model->id], ['class' => 'btn btn-warning btn-xs', 'data-method' => 'post']) ?>
    <?php endif; ?>
    <?php if ($model->getIsBlocked()): ?>
        <?= Html::a(Yii::t('user', 'Unblock'), ['block', 'id' => $model->id], ['class' => 'btn btn-success btn-xs', 'data-method' => 'post', 'data-confirm' => Yii::t('user', 'Are you sure to block this user?')]) ?>
    <?php else: ?>
        <?= Html::a(Yii::t('user', 'Block'), ['block', 'id' => $model->id], ['class' => 'btn btn-danger btn-xs', 'data-method' => 'post', 'data-confirm' => Yii::t('user', 'Are you sure to block this user?')]) ?>
    <?php endif; ?>
</h1>

<?php if (Yii::$app->getSession()->hasFlash('admin_user')): ?>
    <div class="alert alert-success">
        <p><?= Yii::$app->getSession()->getFlash('admin_user') ?></p>
    </div>
<?php endif; ?>

<!--<p class="bg-info">
        <?= Yii::t('user', 'Registered at {0, date, MMMM dd, YYYY HH:mm} from {1}', [$model->created_at, is_null($model->registered_from) ? 'N/D' : long2ip($model->registered_from)]) ?>
        <br/>
        <?php if (Yii::$app->getModule('user')->confirmable && $model->getIsConfirmed()): ?>
            <?= Yii::t('user', 'Confirmed at {0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]) ?>
            <br/>
        <?php endif; ?>
        <?php if (!is_null($model->logged_in_at)): ?>
            <?= Yii::t('user', 'Last login at {0, date, MMMM dd, YYYY HH:mm} from {1}', [$model->logged_in_at, long2ip($model->logged_in_from)]) ?>
        <?php endif;?>
        <?php if ($model->getIsBlocked()): ?>
            <?= Yii::t('user', 'Blocked at {0, date, MMMM dd, YYYY HH:mm}', [$model->blocked_at]) ?>
        <?php endif;?>
    </p> -->

<div class="row">

<!-- NEW COL START -->
<article class="col-sm-12 col-md-8 col-lg-8" style="margin-bottom: 15px;">

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

       <header><span class="widget-icon"> <i class="fa fa-user"></i> </span><h2>User</h2></header>
     
        <div>
                <div class="jarviswidget-editbox">

                </div>

                <div class="widget-body no-padding">
<div class="sitedetails-form">
        <?php $form = ActiveForm::begin([
                     'options'=>['class'=>'smart-form'],
                     'fieldConfig'=>['labelOptions'=>['class'=>'label', 'style'=>'font-weight:bold;'],'options'=>['tag'=>'section']]
                    ]); ?>
    <fieldset>
        <?= $form->field($model, 'username')->textInput(['maxlength' => 25]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'role')->textInput(['maxlength' => 255]) ?>
    </fieldset>
    <footer>
            <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-primary']) ?>
    </footer>

        <?php ActiveForm::end(); ?>
    </div>
                </div></div></div></article></div>
