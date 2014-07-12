<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dektrium\user\widgets\Connect;
use yii\helpers\BaseHtml;


\backend\assets\smartIndexBundle::register($this);
Yii::$app->controller->layout = '@app/views/layouts/login';
$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

                <?php $form = ActiveForm::begin(['id' => 'login-form','options' => ['class' => 'smart-form client-form']]) ?>
                <header>
                    Log In <?= \yii\helpers\Url::base('http') ?>
                </header>
<fieldset>
                <section>
                <label class="label">Username</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                <?= BaseHtml::activeTextInput($model, 'login'); ?>
                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter your username</b></label>
                </section>
    
                <section>
                <label class="label">Password</label>
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                <?= BaseHtml::activePasswordInput($model, 'password'); ?>
                <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>

                </section>

                </fieldset>
                
                <footer>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                </footer>
                <?php ActiveForm::end(); ?>

        <?= Connect::widget([
            'baseAuthUrl' => ['/user/security/auth']
        ]) ?>
