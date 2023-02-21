<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\ServiceAppointment */ 

$this->title = Yii::t('app', 'Appointment Calendar');
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
            <div class="card col-md-12 col-lg-12 col-xl-12">
              <div class="tiva-events-calendar full" data-view="calendar" data-start="sunday" data-switch="show"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
<div class="row">
  <div class="col-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"> Appointment Detail </h3>
      </div>
     
        <div class="card-body">
          <div class="event-schedule-area-two bg-color pad100">
            <div class="tab-content" id="myTabContent">
             <div id="partial_view_container">
                  <?php
				    if($dataProvider->getTotalCount() > 0) { 
				  ?>
                  <table class="table" id="appointment-detail">
                    <thead>
                      <tr>
                        <th class="text-center" scope="col">Date</th>
                        <th scope="col" colspan="2">Instructor</th>
                        <th scope="col">Customer</th>
                        <th class="text-center" scope="col" colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					 }
					?>
                      <?= ListView::widget([
						  'dataProvider' => $dataProvider,
						  'itemOptions' => ['tag' => null],
						  'itemView' => '_listing',
						  'emptyText' => 'I’m sorry, we can’t find any appointment in this date. Please select another date',
						  'summary'  => '',
						  'options' => [
							  'class' => 'row',
							  'id' => false
						  ],
						  'viewParams' => [
							'fullView' => true,
							'Appointment_Date' => $Appointment_Date
						  ],
						 ]); ?>
                    <?php
				     if($dataProvider->getTotalCount() > 0) { 
				   ?>
                    </tbody>
                  </table>
                  <?php
					 }
				  ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
