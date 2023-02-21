<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
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
    <?= $form->field($model, '['.$model->Day_ID.']id')->hiddenInput()->label(false)?>
    <?=$model['day']->Name?>
  </div>
  <div class="col-md-12 col-lg-6 col-xl-4">
    <?= $form->field($model, '['.$model->Day_ID.']Start_Time')->dropDownList(ArrayHelper::map(MReportingTime::find()->where(array('Type' => 'STRAT_END','Record_Status' => 'C'))->all(), 'id', 'Time_Slot'), array('class' => 'form-control selectpicker','data-live-search'=>'true'))->label(false)?>
  </div>
  <div class="col-md-12 col-lg-6 col-xl-4">
    <?= $form->field($model, '['.$model->Day_ID.']End_Time')->dropDownList(ArrayHelper::map(MReportingTime::find()->where(array('Type' => 'STRAT_END','Record_Status' => 'C'))->all(), 'id', 'Time_Slot'), array('class' => 'form-control selectpicker','data-live-search'=>'true'))->label(false)?>
  </div>
  <div class="col-md-12 col-lg-6 col-xl-1">
    <a href="javascript:void(0)" class="badge bg-success" onclick="addBreak(<?=$model->Day_ID?>)">Add Break</a>
  </div>
</div>
<hr/>
<div id="expand_break_hour_<?=$index+1?>">
	<?= ListView::widget([
      'dataProvider' => Yii::$app->instructor->getBreak($model->Day_ID),
      'itemOptions' => ['tag' => null],
      'itemView' => '_break',
      'emptyText' => '',
      'summary'  => '',
      'options' => [
          'class' => '',
          'id' => false
      ],
      'viewParams' => [
        'fullView' => true,
        'form' => $form
      ],
    ]); ?>
</div>