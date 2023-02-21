<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Learn English With Divya');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- ======= Hero Section ======= -->

<section id="hero" class="d-flex justify-content-center align-items-center">
  <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
    <h1>Welcome To Divya<br>
      English Academy</h1>
    <p>My course content is interactive, student-centered, useful, and relevant in real-life<br/>
      situations. Each lesson plan is personalized to suit the needs and goals of the student with<br/>
      aim to make them more confident and fluent in speaking English.</p>
    <a href="<?=Url::toRoute(['services/our-service'])?>" class="btn-get-started">OUR COURSES</a> </div>
</section>
<!-- End Hero -->

<main id="main"> 
  <!-- =======  WHAT DO YOU NEED? Section ======= -->
  <section id="services" class="services">
    <div class="container">
      <h2 class="text-center" style="font-size:3em; padding-bottom:0.5em;padding:60px 0px; "> WHAT DO YOU NEED? </h2>
      <div class="row">
        <div class="col-md-4">
          <div class="icon-box"> <i class="" style="border:1px solid #333; border-radius:100%; margin-right: 0.3em; height:100px; width:100px; margin-top: 15px;"> <img src="<?= Yii::$app->request->baseUrl?>/img/book.png"  style="padding: 20px; " ></i>
            <h4>Variety Of Courses</h4>
            <p style="font-size:11px;">Depending upon your needs you can chose from a variety of basic to advance level courses. </p>
          </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
          <div class="icon-box"> <i class="" style="border:1px solid #333; border-radius:100%; margin-right: 0.3em; height:100px; width:100px; margin-top: 15px;  "> <img src="<?= Yii::$app->request->baseUrl?>/img/ind-app.png" style="padding: 20px;"></i>
            <h4>Individual Approach</h4>
            <p style="font-size:11px;">Every student is given a personal attention and each lesson plan is personalized to suit the needs and goals of the student.</p>
          </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0 ">
          <div class="icon-box"> <i class="" style="border:1px solid #333; border-radius:100%; margin-right: 0.3em; height:100px; width:100px; margin-top: 15px;"> <img src="<?= Yii::$app->request->baseUrl?>/img/qlt-tch.png" style="padding: 7px;" ></i>
            <h4> Qualified Teacher</h4>
            <p style="font-size:11px;">I am a Cambridge CELTA certified, Bachelor of Education and Bachelor of Arts native English speaker and I’m also a certified IELTS teacher.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End  WHAT DO YOU NEED?  Section --> 
  <!-- ======= WELCOME TO DIVYA ONLINE ENGLISH ACADEMY (DOEA) Section ======= -->
  <section id="about-boxes" class="about-boxes">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="card">
            <div class="card-body" style="padding:6em 1em; background-color: rgba(114, 108, 101, 0.95); text-align:center; padding-top:12em; opacity: 0.7;">
              <h5 class="title text-center text-white"  style="font-size:2em; font-weight:200;"> Learn In An Engaging, Interactive, <br/>
                and Fun Environment.<br/>
                <p style="color: rgba(255, 255, 255, 0.35); font-size:10px;"> Learning with Divya</p>
                <p style="font-size:10px; " class="text-center text-white">Book a trial lesson with me so we can discuss your <br/>
                  goals and how I can  help you achieve them. </p>
              </h5>
              <a href="<?=Url::toRoute(['services/our-service'])?>" class="btn-gray" style="background-color:#333333; padding:0.8em 2em; color:#fff; ">BOOK A DEMO CLASS</a> </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="card" style="padding:2em 1em; text-align:center;">
            <div class="card-body">
              <h5 class="title text-center"  style="font-size:2em; font-weight:700;"> WELCOME TO DIVYA ONLINE ENGLISH ACADEMY (DOEA)</a></h5>
              <span style="font-size:13px;" class="text-center">Hi everyone! I’m Divya! I’m an Indian-origin Australian citizen and a native English speaker. My aim is to make my students more confident and fluent in speaking English. My lessons concentrate on developing reading, writing, listening skills, as well as conversational English with a focus on vocabulary, grammar, and pronunciation. I'm also an IELTS, TOEFL, and Business English instructor.<br/>
              My classes are engaging, interactive, and fun. I maintain a friendly classroom environment where my students feel comfortable and are not afraid to make mistakes. I can teach students across all levels-beginner to advanced. </span><br/>
              <br/>
              <a href="<?=Url::toRoute(['site/about'])?>" class="btn-blue" style="background-color:#20295b; padding:0.8em 2em; color:#fff; ">Learn More</a> </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End WELCOME TO DIVYA ONLINE ENGLISH ACADEMY (DOEA) Section --> 
  <!-- =======  Learn english with divya  Section ======= -->
  <div class="container-video">
    <video autoplay muted loop id="myVideo" style="height: 48em;" >
      <source src="<?= Yii::$app->request->baseUrl?>/img/video.mp4" type="video/mp4">
    <h2 class="center" style="font-size:4em; font-style: italic;  font-family:time-roman; font-weight:700; color:#fff;"> Learn English With Divya </h2>
    </video>
    
  </div>
  <div class="relative"> </div>
  <!-- =======  End learn english with divya  Section ======= --> 
  
  <!-- ======= Popular Courses Section ======= -->
  <section id="popular-courses" class="courses">
    <div class="container" data-aos="fade-up">
      <h2 class="text-center" style="font-size:3em; padding-bottom:0.5em; padding:1em 0px;">POPULAR COURSES</h2>
      <div class="row" data-aos="zoom-in" data-aos-delay="100">
        <?= ListView::widget([
          'dataProvider' => $dataProviderMServices,
          'itemOptions' => ['tag' => null],
          'itemView' => '_service',
          'emptyText' => '',
          'summary'  => '',
          'options' => [
              'class' => 'row aos-init aos-animate',
              'id' => false
          ],
          'viewParams' => [
            'fullView' => true,
          ],
         ]); ?>
        <!-- End Course Item--> 
      </div>
    </div>
  </section>
  <!-- End Popular Courses Section --> 
  <!-- ======= Services Section ======= -->
  <section id="services" class="services" style="padding:4em 0">
    <div class="container">
      <h2 class="text-center" style="font-size:3em; "> BOOK YOUR TRAIL CLASS TODAY </h2>
      <p class="text-center" style="color: #a8a8a8;" >There’s no better time than NOW to start learning, so let's start on this amazing journey together!!</p>
      <center>
        <a href="<?=Url::toRoute(['services/our-service'])?>" class="btn" style="background-color:#20295b; padding:0.8em 2em; color:#fff; ">Book Now</a>
      </center>
    </div>
  </section>
  <!-- End Services Section --> 
  
  <!-- ======= Services Section ======= -->
  <section id="services" class="services" style="background-color:#e8f3f5; width:100%;">
    <div class="container" >
      <h2 class="text-center" style="font-size:3em; padding-bottom:0.5em;padding:60px 0px; "> WHAT MY STUDENTS SAY? </h2>
      <div class="row">
        <div class="col-md-4">
          <div class="icon-box"> <i class="" style="border:1px solid #333; border-radius:100%; margin-right: 0.3em; height:100px; width:100px; margin-top: 15px;  "> <img src="<?= Yii::$app->request->baseUrl?>/img/ind-app.png" style="padding: 20px;"></i>
            <h4>Angela Smith</h4>
            <p style="font-size:11px;">Divya is an amazing teacher with solid command over the language. She delivers more value than she promises through her courses. </p>
          </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
          <div class="icon-box"> <i class="" style="border:1px solid #333; border-radius:100%; margin-right: 0.3em; height:100px; width:100px; margin-top: 15px;  "> <img src="<?= Yii::$app->request->baseUrl?>/img/ind-app.png" style="padding: 20px;"></i>
            <h4>Manjeet Singh </h4>
            <p style="font-size:11px;">I prepared for IELTS with Divya and with her help was able to score 7+ bands in the first attempt itself. Coming from a non-English speaking background it was not easy for me to prepare but Divya made the learning really easy for me. I will be always be thankful to her to help me achieve my goal.</p>
          </div>
        </div>
        <div class="col-md-4 mt-4 mt-md-0">
          <div class="icon-box"> <i class="" style="border:1px solid #333; border-radius:100%; margin-right: 0.3em; height:100px; width:100px; margin-top: 15px;"> <img src="<?= Yii::$app->request->baseUrl?>/img/ind-app.png" style="padding: 20px;" ></i>
            <h4> Samuel Paul</h4>
            <p style="font-size:11px;">I took online business English writing classes from Divya. My experience with her was really good as I was able to learn more than I was looking for.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services Section --> 
  
  <!-- ======= Services Section ======= -->
  <section id="services" class="services" style="padding:4em 0em;" >
    <div class="container">
        <h2 class="text-center" style="font-size:3em;"> FOLLOW US ON SOCIAL MEDIA </h2>
        <p class="text-center" style="margin-bottom:3em; color: #a8a8a8;"  >Follow me on your favorite social media platforms to get latest updates and valuable tricks and tips.</p>
      <center>
        <div class="social-links text-center pt-3 pt-md-0"> <a href="#" class="twitter" style="color: #333;font-size: 34px;padding-right: 1em;"><i class="bx bxl-twitter"></i></a> <a href="#" class="facebook" style="color: #333;font-size: 34px;padding-right: 1em;"><i class="bx bxl-facebook"></i></a> <a href="#" class="instagram" style="color: #333;font-size: 34px;padding-right: 1em;"><i class="bx bxl-instagram"></i></a> <a href="#" class="google-plus" style="color: #333;font-size: 34px;padding-right: 1em;"><i class="bx bxl-skype"></i></a> <a href="#" class="linkedin" style="color: #333;font-size: 34px;padding-right: 1em;"><i class="bx bxl-linkedin"></i></a> </div>
      </center>
    </div>
  </section>
  <!-- End Services Section --> 
</main>
<!-- End #main -->