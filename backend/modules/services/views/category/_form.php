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
   'action' => ['category/submit'],
   'options' => [
	   'enableAjaxValidation' => true,
	   'id'      => 'create_update_category',
	   'class'   => 'create_update_category',
	   'validateOnBlur' => true
   ]
]); 
?>
<div class="row">
  <div class="col-12 col-sm-12">
    <div class="form-group">
      <?= $form->field($model, 'Name')->textInput(array('class' => 'form-control'))?>
    </div>
  </div>
</div>
<hr />
<div class="row">
  <div class="col-12">
    <?= Html::Button('Submit', ['class' => 'btn btn-primary btn-block','onclick' => 'submitCategoryData()']) ?>
  </div>
</div>
<?php ActiveForm::end(); ?>
