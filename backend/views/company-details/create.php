<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\CompanyDetails $model
 */

$this->title = 'Create Company Details';
$this->params['breadcrumbs'][] = ['label' => 'Company Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
