<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\IdentityInterface;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\UsersSearch $searchModel
 */

$this->title = 'Company Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'username',
            'first_name',
            'last_name',
            // 'email_address:email',
            // 'role',
            // 'date_added',
            // 'date_updated',
            // 'password',
            // 'company_id',
            // 'last_login',
            // 'password_reset_token',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
