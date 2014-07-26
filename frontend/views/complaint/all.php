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
<div class="container">
<table class="table table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th width="180">Company</th>
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
<ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <li class="active disabled"><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">&raquo;</a></li>
</ul>
</div><!-- @end of container -->