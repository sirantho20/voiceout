<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplaintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Complaints';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Complaint', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'complaint_id',
            'company_id',
            'user_id',
            'cookie_id',
            // 'complaint',
            // 'hashtag',
            // 'is_private',
            // 'rating',
            // 'date_added',
            // 'date_updated',
            // 'published',
            // 'has_picture',
            // 'has_audio',
            // 'read_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
