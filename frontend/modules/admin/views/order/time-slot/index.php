<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\HtmlPurifier;
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<section id="time-slot" class="data-form">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
         <h2>Appointment Slot</h2>
         <p>Choose a Time slot</p>
      </div>
      <div class="row">
        <div class="col-lg-12 order-1 order-lg-2 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
          <div class="info">
            <div class="address"> <i class="bi bi-calendar"></i>
              <h4><?=date("d F", strtotime($Appointment_Date))?></h4>
			  <?php
                $about = array();
                foreach($Instructor->serviceInstructorMappings as $key=>$value) {
                    $about[] = $value['service']->Name;
                }
              ?>
              <p><?='<strong>'.$Instructor->Name.'</strong> ('.implode("/",$about).')'?></p>
            </div>
          </div>
        </div>
      </div><br/>
      <div data-aos="zoom-in" data-aos-delay="100">
        <?= ListView::widget([
              'dataProvider' => $dataProvider,
              'itemOptions' => ['tag' => null],
              'itemView' => '_time-slot',
              'emptyText' => '',
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
      </div>
    </div>
</section>