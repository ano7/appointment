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

<div class="card col-md-12 col-lg-6 col-xl-3"> 
	  <?php if($model->Picture_ID == '') {
         echo Html::img('@web/img/photo2.png',['alt' => 'Instructor Picture','class' => 'card-img-top']);
      } else {
        echo Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => 'Service Picture','class' => 'card-img-top']);
      } ?>
      <div class="card-body">
        <a href="#" onclick="addUpdateServicesInfo(<?=$model->id?>)">
            <h5 class="text-center">
              <?=$model->Name?>
            </h5>
        </a>
        <p class="text-center">
          <?=$model['category']->Name?>
        </p>
        <hr />
        <div class="row">
          <div class="col-md-4"> <i class="fa fa-signal" aria-hidden="true"></i><br/>
            <?=ucfirst(strtolower($model->Course_Level))?>
          </div>
          <div class="col-md-4 text-right"> <i class="fa fa-clock" aria-hidden="true"></i><br/>
            <?=$model->Duration_Info?>
          </div>
          <div class="col-md-4 text-right"> <i class="fa fa-credit-card" aria-hidden="true"></i><br/>
            <?=$model->Price?>
          </div>
        </div>
      </div>
</div>
 