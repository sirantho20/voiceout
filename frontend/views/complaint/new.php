<?php
/**
 * @var yii\web\View $this
 */

use frontend\components\ComplaintWidget;
$this->title = 'New Complaint';
?>
<?= ComplaintWidget::widget(['mode'=>'advanced']); ?>
