<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

/******Start Model*******/
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<?= ListView::widget([
  'dataProvider' => $dataProvider,
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
  ],
]); ?>