<?php

use yii\helpers\Html;
use app\models\Company;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\models\Complaint $model
 */

$this->title = 'All Complaints';
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Company</th>
            <th>Complaint</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $n= 1; foreach ($model as $complaint): ?>
        <tr>
            <td><?php echo $n; $n++; ?></td>
            <td><?php echo Company::getCompanyName($complaint->company_id); ?></td>
            <td><?php echo "<a href='".Url::toRoute("/complaint/".$complaint->slug)."'>".Html::encode($complaint->complaint)."</a>"; ?></td>
            <td><?php echo $complaint->date_added; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        
    </tfoot>
</table>