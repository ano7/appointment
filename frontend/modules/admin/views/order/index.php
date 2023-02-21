<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MServices */ 

$this->title = Yii::t('app', 'View Service');
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
  <!-- ======= Breadcrumbs ======= -->
  
  <div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2>Order Details</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  <!-- End Cource Details Section --> 
  <!-- ======= Calendar Tabs Section ======= -->
  <section id="appointment-div" class="course-details">
    <div class="container" data-aos="fade-up">
      <div class="row ">
        <div class="col-lg-12 ">
          <div class="tiva-events-calendar full" data-view="calendar" data-start="sunday" data-switch="show"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Calendar Section --> 
  <!-- ======= Appointment Section ======= -->
  <?php
   if($dataProvider->getTotalCount() > 0) { 
  ?>
  <div id="partial_view_container">
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Order Detail</h2>
          <p>Your Order History</p>
        </div>
        <div data-aos="zoom-in" data-aos-delay="100">
          <div class="event-schedule-area-two bg-color pad100">
            <div class="tab-content" id="myTabContent">
              <table class="table" id="appointment-detail">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Date</th>
                    <th scope="col" colspan="2">Instructor</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Price</th>
                    <th class="text-center" scope="col">Status</th>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php }  else { ?>
  <div id="partial_view_container">
      <section id="trainers" class="trainers">
        <div class="container" data-aos="fade-up">
          <div class="alert alert-danger" role="alert"> I’m sorry, we can’t find any appointment in this <strong><?=date('d F, Y',strtotime($Appointment_Date))?></strong>. Please select another date </div>
        </div>
      </section>
  </div>
  <?php } ?>
  <!-- End Appointment Section --> 
</main>
<!-- End #main -->
<div class="modal fade show" id="reschedule-info" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> </div>
  </div>
</div>