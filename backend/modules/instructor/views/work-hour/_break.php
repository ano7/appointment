<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

/******Start Model*******/
use common\models\MReportingTime;
use common\models\MTimeslot;
 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */  
$index = $index+1;
?>
<div class="row"> 
   <div class="col-md-12 col-lg-6 col-xl-3">
     <?= $form->field($model, '['.$model['Day_ID'].']['.$index.']id')->hiddenInput()->label(false)?>
   </div>
   <div class="col-md-12 col-lg-6 col-xl-4">
        <?= $form->field($model, '['.$model['Day_ID'].']['.$index.']Start_Time')->dropDownList(ArrayHelper::map(MReportingTime::find()->where(array('Type' => 'STRAT_END','Record_Status' => 'C'))->all(), 'id', 'Time_Slot'), array('onchange' => 'getEndTimeSlot('.$model['Day_ID'].$index.')','id' => 'Break_Start_Time_'.$model['Day_ID'].$index,'class' => 'form-control selectpicker','data-live-search'=>'true'))->label(false)?>
   </div>
   <div class="col-md-12 col-lg-6 col-xl-4">
      <?= $form->field($model, '['.$model['Day_ID'].']['.$index.']End_Time')->dropDownList(ArrayHelper::map(MTimeslot::find()->where(array('Start_Time' => $model->Start_Time,'Record_Status' => 'C'))->orderBy(['id' => SORT_DESC])->all(), 'End_Time',function($timeslot) {
		  $modelMReportingTime = MReportingTime::find()->where(array('id' => $timeslot->End_Time))->one();
		  return $modelMReportingTime->Time_Slot;}), array('id' => 'Break_End_Time_'.$model['Day_ID'].$index,'class' => 'form-control selectpicker','data-live-search'=>'true'))->label(false)?>
   </div>
   <div class="col-md-12 col-lg-6 col-xl-1">
   </div>
</div>
<hr/> 