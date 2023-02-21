<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\helpers\HtmlPurifier;
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<?php
	echo Html::hiddenInput('Appointment_Date', $Appointment_Date,array('id' => 'Appointment_Date'));
?>
<div class="social timeslot btn-wrap text-center"> 
  <a href="javascript:void(0)" class="btn-buy" onclick="bookAppointment(<?=$model['id']?>)"><?=$model['Start_Time']?> - <?=$model['End_Time']?>
  </a> 
</div>
