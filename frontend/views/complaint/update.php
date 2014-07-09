<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Complaint $model
 */

$this->title = 'Update Complaint: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Complaints', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="complaint-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
