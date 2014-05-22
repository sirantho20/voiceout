<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\CompanyUsers $model
 */

$this->title = 'Create Company Users';
$this->params['breadcrumbs'][] = ['label' => 'Company Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?= print_r($errors) ?>
