<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\ServiceAppointment */ 


?>
<?php
  if($dataProvider->getTotalCount() > 0) { 
?>
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
<?php }  else { ?>
<section id="trainers" class="trainers">
  <div class="container" data-aos="fade-up">
    <div class="alert alert-danger" role="alert"> I’m sorry, we can’t find any appointment in this <strong><?=date('d F, Y',strtotime($Appointment_Date))?></strong>. Please select another date </div>
  </div>
</section>
<?php } ?>
