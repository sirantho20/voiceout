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
use yii\helpers\BaseHtml;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\User $user
 */
\backend\assets\smartIndexBundle::register($this);
Yii::$app->controller->layout = '@app/views/layouts/signup';
$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>

                <?php $form = ActiveForm::begin([
                    'id' => 'smart-form-register',
                    'options' => ['class' => 'smart-form client-form']
                ]); ?>
    		<header>
                         FREE Registration
                </header>
    <fieldset>
        <section>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                <?= BaseHtml::activeTextInput($model, 'username',['placeholder'=>'Username']); ?>
                <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
        </section>
        <section>
            <label class="input"> <i class="icon-append fa fa-envelope"></i>
            <?= BaseHtml::activeTextInput($model, 'email',['placeholder'=>'Email']); ?>
            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
        </section>
        <section>
            <label class="input"> <i class="icon-append fa fa-lock"></i>
            <?= BaseHtml::activeTextInput($model, 'password',['placeholder'=>'Password']); ?>
            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
        </section>
                
    </fieldset>
    <footer>
        <?= 'Already have account? '.Html::a(Yii::t('user', 'Login'),['/user/login']) ?>
        <?= Html::submitButton('Signup', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
    </footer>
                <?php ActiveForm::end(); ?>

