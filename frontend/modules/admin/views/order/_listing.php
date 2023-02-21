<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

/******Start Model*******/
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<tr class="inner-box">
  <th scope="row"> <div class="event-date"> <span><?=date("d",strtotime($model->Appointment_Date));?></span>
      <p><?=date("M",strtotime($model->Appointment_Date));?></p>
    </div>
  </th>
  <td>
    <div class="event-img">
      <?php if($model['instructor']->Picture_ID == '') {
         echo Html::img('@web/img/trainer-1.jpg',['alt' => 'Service Picture','class' => 'img-fluid']);
      } else {
        echo Html::img("data:".$model['instructor']['picture']->Type.";base64,".$model['instructor']['picture']->Content,['alt' => $model['instructor']->Name.' Picture','class' => 'img-fluid']);
      } ?> 
    </div>
  </td>
  <td>
    <div class="event-wrap">
      <h3><a href="#"><?=$model['instructor']->Name?></a></h3>
      <div class="meta">
        <div class="organizers contact_no"><i class="nav-icon fa fa-mobile"></i> <?=$model['instructor']->Contact_No?></a> </div>
        <div class="time"> <span><i class="fa fa-envelope" aria-hidden="true"></i> <?=$model['instructor']['user']->email?></span> </div>
      </div>
    </div>
  </td>
  <td>
    <div class="event-wrap">
      <h3><a href="#"><?=$model['service']->Name?></a></h3>
      <div class="meta">
        <div class="categories"> <a href="javascript:void(0)"><?=$model['service']['category']->Name?></a> </div>
        <div class="time"> <span><i class="fa fa-clock" aria-hidden="true"></i> <?=date('h:i:s A', strtotime($model['timeslot']['startTime']->Time_Slot));?> - <?=date('h:i:s A', strtotime($model['timeslot']['endTime']->Time_Slot));?></span> </div>
      </div>
    </div>
  </td>
  <td>
    <div class="event-wrap">
     <h3><a href="#">₹<?=$model['service']->Price?></a></h3>
    </div>
  </td>
  <td>
    <div class="primary-btn"> 
      <a class="btn btn-primary" href="javascript:void(0)" onclick="reScheduleAppointment(<?=$model->id?>)"><?=ucfirst(strtolower($model->Appointment_Status == 'RESCHEDULED') ? 'Request for Re-Schedule' : $model->Appointment_Status)?></a> 
    </div>
  </td>
</tr>