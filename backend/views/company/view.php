<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use yii\web\UrlManager;
use yii\helpers\BaseHtml;

/**
 * @var yii\web\View $this
 * @var backend\models\Company $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo BaseHtml::script('alert("tony");');
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                
            ],
        ]);
        ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'company_name',
            'date_added',
            'date_updated',
            'confirmed',
            'industry_id',
            'category_id',
            'slug',
            'is_registered',
            'license_package',
        ],
    ]) ?>

</div>
