<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\CompanyDetailsSearch $searchModel
 */

$this->title = 'Company Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'email_address:email',
            'phone_number',
            'address_line_1',
            // 'address_line_2',
            // 'city',
            // 'country_id',
            // 'logo_pic',
            // 'wallpaper_pic',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<?php 
echo Yii::$app->user->identity->company_id;
?>
