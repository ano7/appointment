<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MServices */ 

$this->title = Yii::t('app', 'View Service');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">
            <?=$this->title?>
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-9">
              <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="custom-tabs-one-description-tab" data-toggle="pill" href="#custom-tabs-one-description" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Description</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="custom-tabs-one-curriculum-tab" data-toggle="pill" href="#custom-tabs-one-curriculum" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Curriculum</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="custom-tabs-one-faq-tab" data-toggle="pill" href="#custom-tabs-one-faq" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">FAQ</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="custom-tabs-one-announcement-tab" data-toggle="pill" href="#custom-tabs-one-announcement" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Announcement</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="custom-tabs-one-reviews-tab" data-toggle="pill" href="#custom-tabs-one-reviews" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Reviews</a> </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-one-description" role="tabpanel" aria-labelledby="custom-tabs-one-description-tab">
                      <div class="card card-widget">
                        <div class="card-body"> 
						  <?php if($model->Picture_ID == '') {
                             echo Html::img('@web/img/photo2.png',['alt' => 'Instructor Picture','class' => 'img-fluid pad']);
                          } else {
                            echo Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => 'Service Picture','class' => 'img-fluid pad']);
                          } ?>
                          <br/>
                          <br/>
                          <p>
                            <?=$model->Description?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-curriculum" role="tabpanel" aria-labelledby="custom-tabs-one-curriculum-tab"> Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. </div>
                    <div class="tab-pane fade" id="custom-tabs-one-faq" role="tabpanel" aria-labelledby="custom-tabs-one-faq-tab">
                      <div class="card-body">
                        <div id="accordion">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h4 class="card-title w-100"> <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false"> Collapsible Group Item #1 </a> </h4>
                            </div>
                            <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                              <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                labore sustainable VHS. </div>
                            </div>
                          </div>
                          <div class="card card-primary">
                            <div class="card-header">
                              <h4 class="card-title w-100"> <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false"> Collapsible Group Danger </a> </h4>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                              <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                labore sustainable VHS. </div>
                            </div>
                          </div>
                          <div class="card card-primary">
                            <div class="card-header">
                              <h4 class="card-title w-100"> <a class="d-block w-100" data-toggle="collapse" href="#collapseThree" aria-expanded="true"> Collapsible Group Success </a> </h4>
                            </div>
                            <div id="collapseThree" class="collapse show" data-parent="#accordion" style="">
                              <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                3
                                wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                laborum
                                eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                nulla
                                assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                beer
                                farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                labore sustainable VHS. </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-announcement" role="tabpanel" aria-labelledby="custom-tabs-one-announcement-tab"> Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. </div>
                    <div class="tab-pane fade" id="custom-tabs-one-reviews" role="tabpanel" aria-labelledby="custom-tabs-one-reviews-tab"> Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3">
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                 
                  <h3 class="profile-username text-center"><?=$model->Name?></h3>
                  <p class="text-muted text-center"><?=$model['category']->Name?></p>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item"> Level: <b><?=ucfirst(strtolower($model->Course_Level))?></b> <span class="float-right"><i class="fa fa-signal" aria-hidden="true"></i> </span></li>
                    <li class="list-group-item"> Duration: <b><?=$model->Duration_Info?></b> <span class="float-right"><i class="fa fa-clock" aria-hidden="true"></i></span> </li>
                    <li class="list-group-item"> Price: <b><?=$model->Price?></b> <span class="float-right"><i class="fa fa-credit-card" aria-hidden="true"></i> </span></li>
                  </ul>
                  <a href="#" class="btn btn-success btn-block"><b>Get Course</b></a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
