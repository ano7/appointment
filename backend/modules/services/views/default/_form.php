<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/******Start Model*******/
use common\models\MCategory;

/* @var $this yii\web\View */
/* @var $model common\models\MServices */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([
   'action' => ['submit'],
   'options' => [
	   'enableAjaxValidation' => true,
	   'id'      => 'service_form',
	   'class'   => 'service_form',
	   'validateOnBlur' => true
   ]
]); 
?>
<?php
if (!$model->isNewRecord) {
	echo $form->field($model, 'id')->hiddenInput(array('class' => 'form-control'))->label(false);
} 
?>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'Name')->textInput(array('class' => 'form-control'))?>
    </div>
  </div>
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'Category_ID')->dropDownList(ArrayHelper::map(MCategory::find()->where(array('Record_Status' => 'C'))->all(), 'id', 'Name'), array('prompt' => 'Choose Category','class' => 'form-control selectpicker','data-live-search'=>'true'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'Duration_Info')->textInput(array('class' => 'form-control intOnly'))?>
    </div>
  </div>
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'Price')->textInput(array('class' => 'form-control floatOnly'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'Start_Date')->textInput(array('type' => 'date','class' => 'form-control'))?>
    </div>
  </div>
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'End_Date')->textInput(array('type' => 'date','class' => 'form-control intOnly'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'Course_Level')->dropDownList(array('BEGINNER' => 'Beginner','INTERMEDIATE' => 'Intermediate','ADVANCED' => 'Advanced'), array('prompt' => 'Choose Course Level','class' => 'form-control selectpicker','data-live-search'=>'true'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12">
    <div class="form-group">
      <?= $form->field($model, 'Description')->textArea(array('rows' => 7,'class' => 'form-control'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
	  <?php if($model->Picture_ID == '') {
             echo Html::img('@web/img/user_default_image.png',['alt' => 'Service Picture','id' => 'picture-img-tag','width' => '200px']);
      } else {
        echo Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => 'Service Picture','id' => 'picture-img-tag','width' => '200px']);
      } ?>
      <?= $form->field($picture, 'Content')->textInput(array('type'=>'file','id' => 'picture-img','onclick' => 'showPreview()'))->label('Profile picture (max. 5 MB)') ?>
    </div>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-1">
    <?= Html::Button('Submit', ['class' => 'btn btn-primary btn-block','onclick' => 'submitServiceData()']) ?>
  </div>
</div>
<?php ActiveForm::end(); ?>
