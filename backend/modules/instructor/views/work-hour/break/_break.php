<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

/******Start Model*******/
use common\models\MReportingTime;
 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */  
?>
<div class="row"> 
   <div class="col-md-12 col-lg-6 col-xl-3">
     <?= Html::hiddenInput('MBreakhour['.$model->Day_ID.'][id]', $model->Day_ID, ['value' => $model->id]); ?>
   </div>
   <div class="col-md-12 col-lg-6 col-xl-4">
        <?= Html::dropDownList('MBreakhour['.$model->Day_ID.'][Start_Time]', $model->Start_Time, ArrayHelper::map(MReportingTime::find()->where(array('Type' => 'STRAT_END','Record_Status' => 'C'))->all(), 'id', 'Time_Slot'), array('class' => 'form-control selectpicker','data-live-search'=>'true')) ?>
   </div>
   <div class="col-md-12 col-lg-6 col-xl-4">
      <?= Html::dropDownList('MBreakhour['.$model->Day_ID.'][End_Time]', $model->End_Time, ArrayHelper::map(MReportingTime::find()->where(array('Type' => 'STRAT_END','Record_Status' => 'C'))->all(), 'id', 'Time_Slot'), array('class' => 'form-control selectpicker','data-live-search'=>'true')) ?>
   </div>
   <div class="col-md-12 col-lg-6 col-xl-1">
   </div>
</div>
<hr/>