<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/******Start Model*******/
use common\models\MCategory;

/* @var $this yii\web\View */
/* @var $model common\models\MCategory */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
	$form = ActiveForm::begin([
	   'action' => ['credit-wallet'],
	   'options' => [
		   'enableAjaxValidation' => true,
		   'id'      => 'credit_wallet',
		   'class'   => 'credit_wallet',
		   'validateOnBlur' => true
	   ]
	]); 
?>
<div class="row">
  <div class="col-12 col-sm-12"> 
    <div class="form-group">
      <?= Html::textInput('Amount', null, ['class' => 'form-control border-top-0 border-right-0 border-left-0']); ?>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
