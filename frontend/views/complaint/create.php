<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Complaint $model
 */

$this->title = 'Create Complaint';
$this->params['breadcrumbs'][] = ['label' => 'Complaints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complaint-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
