<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\models\Complaint $model
 */

$this->title = 'All Companies';
?>
<div class="container">
<table class="table table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th width="180">Company</th>
            <th>Registered</th>
            <th>Confirmed</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $n= 1; foreach ($model as $company): ?>
        <tr>
            <td><?php echo $n; $n++; ?></td>
            <td><?php echo "<a href='".Url::toRoute("/company/".$company->slug)."'>".Html::encode($company->company_name)."</a>"; ?></td>
            <td><?php echo $company->is_registered; ?></td>
            <td><?php echo $company->confirmed; ?></td>
            <td><?php echo $company->date_added; ?></td>
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