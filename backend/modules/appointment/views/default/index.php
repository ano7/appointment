<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\ServiceAppointment */ 

$this->title = Yii::t('app', 'Appointment');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">
            <?=$this->title?>
          </h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-12">
              <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link" id="custom-tabs-one-description-tab" data-toggle="pill" href="#custom-tabs-one-previous" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" onclick="getAppointment('Previous')">Previous</a> </li>
                    <li class="nav-item"> <a class="nav-link active" id="custom-tabs-one-curriculum-tab" data-toggle="pill" href="#custom-tabs-one-today" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="getAppointment('Today')">Today</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="custom-tabs-one-faq-tab" data-toggle="pill" href="#custom-tabs-one-upcoming" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false" onclick="getAppointment('Upcoming')">Upcoming</a> </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade" id="custom-tabs-one-previous" role="tabpanel" aria-labelledby="custom-tabs-one-curriculum-tab">
                      <div class="event-schedule-area-two bg-color pad100">
                        <div class="tab-content" id="myTabContent">
                          <div class="table-responsive">
                            <div id="partial_view_container_Previous">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade active show" id="custom-tabs-one-today" role="tabpanel" aria-labelledby="custom-tabs-one-curriculum-tab">
                      <div class="event-schedule-area-two bg-color pad100">
                        <div class="tab-content" id="myTabContent">
                          <div class="table-responsive">
                            <div id="partial_view_container_Today">
                              <?php
							    if($dataProvider->getTotalCount() > 0) { 
							  ?>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" scope="col">Date</th>
                                    <th scope="col" colspan="2">Instructor</th>
                                    <th scope="col">Customer</th>
                                    <th class="text-center" scope="col" colspan="2">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?= ListView::widget([
                                      'dataProvider' => $dataProvider,
                                      'itemOptions' => ['tag' => null],
                                      'itemView' => '_listing',
                                      'emptyText' => '',
                                      'summary'  => '',
                                      'options' => [
                                          'class' => 'row',
                                          'id' => false
                                      ],
                                      'viewParams' => [
                                        'fullView' => true,
                                      ],
                                     ]); ?>
                                </tbody>
                              </table>
                              <?php } else { ?>
                                <div class="alert alert-danger" role="alert"> I’m sorry, we can’t find any appointment for Today.</div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-upcoming" role="tabpanel" aria-labelledby="custom-tabs-one-curriculum-tab">
                      <div class="event-schedule-area-two bg-color pad100">
                        <div class="tab-content" id="myTabContent">
                          <div class="table-responsive">
                            <div id="partial_view_container_Upcoming">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
