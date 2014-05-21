<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\CompanyUsers $model
 */

$this->title = 'Update Company Users: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
