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
	$about = array();
	foreach($model->serviceInstructorMappings as $key=>$value) {
		$about[] = $value['service']->Name;
	}
?>
<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
  <div class="member">
	  <?php if($model->Picture_ID == '') {
         echo Html::img('@web/img/trainer-1.jpg',['alt' => 'Service Picture','class' => 'img-fluid']);
      } else {
        echo Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => $model->Name.' Picture','class' => 'img-fluid']);
      } ?>
    <div class="member-content">
      <h4><?=$model->Name?></h4>
      <span><?=implode("/",$about);?></span>
      <p> Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara </p>
      <div class="social"> <a href=""><i class="bi bi-twitter"></i></a> <a href=""><i class="bi bi-facebook"></i></a> <a href=""><i class="bi bi-instagram"></i></a> <a href=""><i class="bi bi-linkedin"></i></a> </div>
    </div>
  </div>
</div>
