<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\CompanyUsers $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'username',
            'first_name',
            'last_name',
            'email_address:email',
            'role',
            'date_added',
            'date_updated',
            'password',
            'company_id',
            'last_login',
            'password_reset_token',
            'status',
        ],
    ]) ?>

</div>
