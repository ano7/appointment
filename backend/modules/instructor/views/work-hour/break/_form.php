<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/******Start Model*******/
use common\models\MReportingTime;

/* @var $this yii\web\View */
/* @var $model common\models\MCategory */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([
   'action' => ['break-submit'],
   'options' => [
	   'enableAjaxValidation' => true,
	   'id'      => 'create_break',
	   'class'   => 'create_break',
	   'validateOnBlur' => true
   ]
]); 
?>
<?= $form->field($model, 'Day_ID')->hiddenInput()->label(false)?>
<div class="row">
  <div class="col-12 col-sm-12">
    <div class="form-group">
      <?= $form->field($model, 'Start_Time')->dropDownList(ArrayHelper::map(MReportingTime::find()->where(array('Type' => 'STRAT_END','Record_Status' => 'C'))->andWhere(['<>','id', 1])->all(), 'id', 'Time_Slot'), array('prompt' => 'Start Time','onchange' => 'getEndTimeSlot(0)','id' => 'Break_Start_Time_0','class' => 'form-control selectpicker','data-live-search'=>'true'))->label(false)?>
    </div>
  </div>
  <div class="col-12 col-sm-12">
    <div class="form-group">
      <?= $form->field($model, 'End_Time')->dropDownList([], array('prompt' => 'End Time','id' => 'Break_End_Time_0','class' => 'form-control selectpicker','data-live-search'=>'true'))->label(false)?>
    </div>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-12">
    <?= Html::Button('Submit', ['class' => 'btn btn-primary btn-block','onclick' => 'submitBreakData()']) ?>
  </div>
</div>
<?php ActiveForm::end(); ?>
