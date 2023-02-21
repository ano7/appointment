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

<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
  <div class="card bg-light d-flex flex-fill">
    <div class="card-header text-muted border-bottom-0">Instructor</div>
    <div class="card-body pt-0">
      <div class="row">
        <div class="col-7">
          <a href="#" onclick="addUpdateInstructorInfo(<?=$model->id?>)">
              <h2 class="lead">
                <b><?=$model->Name?></b>
              </h2>
          </a>
          <?php
		    $about = array();
		    foreach($model->serviceInstructorMappings as $key=>$value) {
				$about[] = $value['service']->Name;
			}
		  ?>
          <p class="text-muted text-sm"><b>About: </b>
            <?=implode("/",$about);?>
          </p>
          <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span><p>Address:
              <?=$model->Address.','.$model['state']->Name.','.$model['district']->Name?></p>
            </li>
            <br/>
            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #:
              <?=$model->Contact_No?>
            </li>
          </ul>
        </div>
        <div class="col-5 text-center">
          <?=Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => $model->Name.' Picture','id' => 'img-circle img-fluid','width' => '150px','height' => '150px']);?>
        </div>
      </div>
    </div>
    <?php /*?><div class="card-footer">
      <div class="text-right"> <a href="#" class="btn btn-sm bg-teal"> <i class="fas fa-comments"></i> </a> <a href="#" class="btn btn-sm btn-primary"> <i class="fas fa-user"></i> View Profile </a> </div>
    </div><?php */?>
  </div>
</div>
