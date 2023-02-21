<?php
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \use common\models\TUserInfo */

$this->title = Yii::t('app', 'Re-Schedule Appointment');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal-header">
  <h4 class="modal-title">
    <?=$this->title?>
  </h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
    <?php 
		$form = ActiveForm::begin([
		   'action' => ['contact'],
		   'options' => [
			   'enableAjaxValidation' => true,
			   'id'      => 'form-signup',
			   'class'   => 'php-form',
			   'validateOnBlur' => true
		   ]
		]); 
	 ?>
    <div class="row">
      <div class="col-md-6 form-group">
        <?= $form->field($model, 'id')->hiddenInput(array('id' => 'Appointment_ID','class' => 'form-control'))->label(false);?>
        <?= $form->field($model, 'Instructor_ID')->hiddenInput(array('id' => 'Instructor_ID','class' => 'form-control'))->label(false);?>
        <?= $form->field($model, 'Service_ID')->hiddenInput(array('id' => 'Service_ID','class' => 'form-control'))->label(false);?>
        <?= $form->field($model, 'Appointment_Date')->widget(DatePicker::classname(), ['dateFormat' => 'php:M d, Y', 'options' => ['readonly' => true,'id' => 'Appointment_Date','class' => 'form-control','onchange' => 'loadSchedule()'], 'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'maxDate' => '730d', 'minDate' => '0d']])?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
    <div id="instructor-timeslot"></div>
</div>
