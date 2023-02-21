<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;
use yii\helpers\HtmlPurifier;
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MServices */   
?>

<div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
  <div class="card" <?=($index == 1) ? 'style="background-color: #7ac2d7;"' : 'style=""'?>> 
     <?php if($model->Picture_ID == '') {
         echo Html::img('@web/img/course-1.jpg',['alt' => 'Service Picture','class' => 'card-img-top','style' => 'padding: 1em;']);
      } else {
        echo Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => 'Service Picture','class' => 'card-img-top','style' => 'padding: 1em;']);
      } ?>
    <div class="card-body <?=($index == 1) ? 'text-white' : ''?>">
      <h5 class="card-title <?=($index == 1) ? 'text-white' : ''?>" style="font-size:1.8em; font-weight:400;"><a href="<?=Url::toRoute(['services/our-service/view', 'id' => $model->id])?>"><?=$model->Name?></a></h5>
      <sup>$</sup> <span style="font-size: 45px;" > 18 </span> <sup <?=($index == 1) ? 'style=""' : 'style="color: #a8a8a8;"'?>>Hour</sup> <br>
      <hr>
      <span class="card-text <?=($index == 1) ? 'text-white' : ''?>" style="font-size:13px;">It's a fully teacher taught specialist course to improve your speaking skills and to master everyday social interactions.<br/>
      <br/>
      <a href="<?=Url::toRoute(['services/our-service/view', 'id' => $model->id])?>" <?=($index == 1) ? 'style="color:#fff;"' : 'style=""'?>> Read More </a></span> </div>
  </div>
</div>
