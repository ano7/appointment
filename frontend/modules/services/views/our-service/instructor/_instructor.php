<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\helpers\HtmlPurifier;
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<?php
	echo Html::hiddenInput('Service_ID', $model->Service_ID,array('id' => 'Service_ID'));
?>
<?php
	$about = array();
	foreach($model['instructor']->serviceInstructorMappings as $key=>$value) {
		$about[] = $value['service']->Name;
	}
?>
<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
  <div class="member">
	  <?php if($model['instructor']->Picture_ID == '') {
         echo Html::img('@web/img/trainer-1.jpg',['alt' => 'Service Picture','class' => 'img-fluid']);
      } else {
        echo Html::img("data:".$model['instructor']['picture']->Type.";base64,".$model['instructor']['picture']->Content,['alt' => $model['instructor']->Name.' Picture','class' => 'img-fluid']);
      } ?>    
      <div class="member-content">
      <h4><?=$model['instructor']->Name?></h4>
      <span><?=implode("/",$about);?></span>
      <div class="social"> 
        <a href=""><i class="bi bi-twitter"></i></a> <a href=""><i class="bi bi-facebook"></i></a> <a href=""><i class="bi bi-instagram"></i></a> <a href=""><i class="bi bi-linkedin"></i></a> 
     </div>
     <div class="social pricing btn-wrap text-center">
       <a href="javascript:void(0)" class="btn-buy" onclick="getAppointmentCalender(<?=$model['instructor']->User_ID?>)">Book an Appointment</a> 
     </div>
    </div>
  </div>
</div>
