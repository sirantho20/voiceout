<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Complaint */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Complaints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-view">

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
            'complaint_id',
            'company_id',
            'user_id',
            'cookie_id',
            'complaint',
            'hashtag',
            'is_private',
            'rating',
            'date_added',
            'date_updated',
            'published',
            'has_picture',
            'has_audio',
            'read_date',
        ],
    ]) ?>

</div>
