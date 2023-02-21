<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

/******Start Model*******/
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<div class="modal-header">
  <h4 class="modal-title">
    Add Break
  </h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
  <?= $this->render('_form', array(
	'model' =>  $model,
  )) ?>
</div>