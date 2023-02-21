<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/******Start Model*******/
use common\models\MState;
use common\models\MGender;
use common\models\MDistrict;
use common\models\MServices;
/* @var $this yii\web\View */
/* @var $model common\models\TUserInfo */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([
   'action' => ['instructor-user-signup'],
   'options' => [
	   'enableAjaxValidation' => true,
	   'id'      => 'instructor_registeration_form',
	   'class'   => 'instructor_registeration_form',
	   'validateOnBlur' => true
   ]
]); 
?>
<?php
if (!$t_user_info->isNewRecord) {
	echo $form->field($t_user_info, 'id')->hiddenInput(array('class' => 'form-control'))->label(false);
} 
?>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($t_user_info, 'Name')->textInput(array('class' => 'form-control'))?>
    </div>
  </div>
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($t_user_info, 'Gender_ID')->dropDownList(ArrayHelper::map(MGender::find()->where(array('Record_Status' => 'C'))->all(), 'id', 'Name'), array('prompt' => 'Choose Gender','class' => 'form-control selectpicker','data-live-search'=>'true'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($model, 'email')->textInput(array('class' => 'form-control'))?>
    </div>
  </div>
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($t_user_info, 'Contact_No')->textInput(array('class' => 'form-control intOnly'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?php
	    $service_instructor_mapping->Service_ID = Yii::$app->instructor->getInstructorServices($t_user_info->User_ID);
	  ?>
      <?= $form->field($service_instructor_mapping, 'Service_ID')->dropDownList(ArrayHelper::map(MServices::find()->where(array('Record_Status' => 'C'))->all(), 'id', 'Name'), array('prompt' => 'Choose Service','class' => 'form-control selectpicker','multiple' => 'multiple','data-live-search'=>'true'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($t_user_info, 'State_ID')->dropDownList(ArrayHelper::map(MState::find()->where(array('Record_Status' => 'C'))->all(), 'id', 'Name'), array('prompt' => 'Choose State','onchange' => 'getDistrict()','id' => 'State_ID','class' => 'form-control selectpicker','data-live-search'=>'true'))?>
    </div>
  </div>
  <div class="col-12 col-sm-6">
    <div class="form-group">
      <?= $form->field($t_user_info, 'District_ID')->dropDownList(ArrayHelper::map(MDistrict::find()->where(array('State_ID' => $t_user_info->State_ID,'Record_Status' => 'C'))->all(), 'id', 'Name'), array('prompt' => 'Choose District','id' => 'District_ID','class' => 'form-control selectpicker','data-live-search'=>'true'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-12">
    <div class="form-group">
      <?= $form->field($t_user_info, 'Address')->textInput(array('class' => 'form-control'))?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <div class="form-group">
	  <?php if($t_user_info->Picture_ID == '') {
             echo Html::img('@web/img/user_default_image.png',['alt' => 'Instructor Picture','id' => 'picture-img-tag','width' => '200px']);
      } else {
        echo Html::img("data:".$t_user_info['picture']->Type.";base64,".$t_user_info['picture']->Content,['alt' => 'Instructor Picture','id' => 'picture-img-tag','width' => '200px']);
      } ?>
      <?= $form->field($picture, 'Content')->textInput(array('type'=>'file','id' => 'picture-img','onclick' => 'showPreview()'))->label('Profile picture (max. 5 MB)') ?>
    </div>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-1">
    <?= Html::Button('Submit', ['class' => 'btn btn-primary btn-block','onclick' => 'submitInstructorRegisterData()']) ?>
  </div>
</div>
<?php ActiveForm::end(); ?>
