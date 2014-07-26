<?php
/**
 * @var yii\web\View $this
 */

use frontend\components\ComplaintWidget;
$this->title = 'New Complaint';
?>

    <div class="container"><?= ComplaintWidget::widget(['mode'=>'advanced']); ?></div>
