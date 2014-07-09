<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\CompanyDetails $model
 */

$this->title = 'Update Company Details: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
