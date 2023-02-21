<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/******Start Model*******/
use common\models\MState;
use common\models\MGender;
use common\models\MDistrict;
/* @var $this yii\web\View */
/* @var $model common\models\TUserInfo */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([
   'action' => ['customer-user-signup'],
   'options' => [
	   'enableAjaxValidation' => true,
	   'id'      => 'customer_registeration_form',
	   'class'   => 'customer_registeration_form',
	   'validateOnBlur' => true
   ]
]); 
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
      <?=Html::img('@web/img/user_default_image.png',array('id' => 'picture-img-tag'));?>
      <?= $form->field($picture, 'Content')->textInput(array('type'=>'file','id' => 'picture-img','onclick' => 'showPreview()'))->label('Profile picture (max. 5 MB)') ?>
    </div>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-1">
    <?= Html::Button('Submit', ['class' => 'btn btn-primary btn-block','onclick' => 'submitCustomerRegisterData()']) ?>
  </div>
</div>
<?php ActiveForm::end(); ?>
