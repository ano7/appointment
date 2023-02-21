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
      <h2>Course Details</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  <!-- ======= Cource Details Section ======= -->
  <section id="course-details" class="course-details">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-8">
          <?php if($model->Picture_ID == '') {
             echo Html::img('@web/img/course-1.jpg',['alt' => 'Service Picture','class' => 'img-fluid']);
          } else {
            echo Html::img("data:".$model['picture']->Type.";base64,".$model['picture']->Content,['alt' => 'Service Picture','class' => 'img-fluid']);
          } ?>
          <h3>
            <?=$model->Name?>
          </h3>
          <p>
            <?=$model->Description?>
          </p>
        </div>
        <div class="col-lg-4">
          <?php /*?><div class="course-info d-flex justify-content-between align-items-center">
            <h5>Trainer</h5>
            <p><a href="#">Walter White</a></p>
          </div><?php */?>
          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Course Fee</h5>
            <p>₹<?=$model->Price?>/hour</p>
          </div>
          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Duration</h5>
            <p>
              <?=$model->Duration_Info?>
              hrs</p>
          </div>
          <div class="course-info d-flex justify-content-between align-items-center">
            <h5>Course Level</h5>
            <p>
              <?=ucfirst(strtolower($model->Course_Level))?>
            </p>
          </div>
          <div class="pricing btn-wrap text-right">  
            <a href="javascript:void(0)" class="btn-buy get-course-button get-course-modal-id" id="<?=$model->id?>" onclick="getServiceInstructor(<?=$model->id?>)">Get Course</a> 
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Cource Details Section --> 
  <!-- ======= Instructors Tabs Section ======= -->
  <div id="service-instructor"></div> 
  <!-- End Instructors Tabs Section --> 
  <!-- ======= Calendar Tabs Section ======= -->
  <section id="calender-div" class="calendar-details d-none">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
         <h2>Calendar</h2>
         <p>Choose a Specific Date</p>
      </div>
	  <?= Html::hiddenInput('Instructor_ID', null,array('id' => 'Instructor_ID'))?>
      <div class="row ">
        <div class="col-lg-12 ">
          <div class="tiva-events-calendar full" data-view="calendar" data-start="sunday" data-switch="show"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Calendar Section --> 
  <!-- ======= Instructors Tabs Section ======= -->
  <div id="instructor-timeslot"></div>
  <!-- End Instructors Tabs Section --> 
</main>
<!-- End #main -->
