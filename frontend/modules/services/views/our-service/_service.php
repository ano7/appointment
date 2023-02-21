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
<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
  <div class="course-item"> 
	  <?php if($model->Picture_ID == '') {
         echo Html::img('@web/img/course-1.jpg',['alt' => 'Service Picture','class' => 'img-fluid']);
      } else {
        echo Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => 'Service Picture','class' => 'img-fluid']);
      } ?>    <div class="course-content">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><?=$model['category']->Name?></h4>
        <p class="price">₹<?=$model->Price?>/hour</p>
      </div>
      <h3><a href="<?=Url::toRoute(['our-service/view', 'id' => $model->id])?>"><?=$model->Name?></a></h3>
      <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
      <div class="trainer d-flex justify-content-between align-items-center">
        <div class="trainer-profile d-flex align-items-center"><i class="bx bx-chart" aria-hidden="true"></i> <span><?=ucfirst(strtolower($model->Course_Level))?></span> </div>
        <?php /*?><div class="trainer-rank d-flex align-items-center"> <i class="bx bx-user"></i>&nbsp;20
          &nbsp;&nbsp; <i class="bx bx-heart"></i>&nbsp;85 </div><?php */?>
      </div>
    </div>
  </div>
</div>
