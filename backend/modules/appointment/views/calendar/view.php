<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\ServiceAppointment */ 


?>

<?php
if($dataProvider->getTotalCount() > 0) { 
?>
<table class="table" id="appointment-detail">
<thead>
  <tr>
	<th class="text-center" scope="col">Date</th>
	<th scope="col" colspan="2">Instructor</th>
	<th scope="col">Customer</th>
	<th class="text-center" scope="col" colspan="2">Action</th>
  </tr>
</thead>
<tbody>
<?php
 }
?>
  <?= ListView::widget([
	  'dataProvider' => $dataProvider,
	  'itemOptions' => ['tag' => null],
	  'itemView' => '_listing',
	  'emptyText' => 'I’m sorry, we can’t find any appointment in this date. Please select another date',
	  'summary'  => '',
	  'options' => [
		  'class' => 'row',
		  'id' => false
	  ],
	  'viewParams' => [
		'fullView' => true,
		'Appointment_Date' => $Appointment_Date
	  ],
	 ]); ?>
<?php
 if($dataProvider->getTotalCount() > 0) { 
?>
</tbody>
</table>
<?php
 }
?>
		
