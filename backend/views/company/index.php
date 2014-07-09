<?php

use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\grid\GridView;
use backend\assets\smartIndexBundle;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\CompanySearch $searchModel
 */
smartIndexBundle::register($this);
$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false">
    <header>
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>No Padding</h2>
    </header>
    <div>
    <div class="widget-body no-padding">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'company_name',
            'date_added',
            'date_updated',
            // 'confirmed',
            // 'industry_id',
            // 'category_id',
            // 'slug',
            // 'is_registered',
            // 'license_package',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
            
    </div>

</div>
</div>
    
</div>

