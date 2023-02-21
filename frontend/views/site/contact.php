<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
  
  <!-- ======= Breadcrumbs ======= -->
  
  <div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2>Contact Us</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  
  <!-- ======= Contact Section ======= -->
  <section id="data-form" class="data-form">
    <div data-aos="fade-up">
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="container" data-aos="fade-up">
      <div class="row mt-5">
        <div class="col-lg-4">
          <div class="info">
            <div class="address"> <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
            <div class="email"> <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>info@example.com</p>
            </div>
            <div class="phone"> <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+1 5589 55488 55s</p>
            </div>
          </div>
        </div>
        <div class="col-lg-8 mt-5 mt-lg-0">
          <?php 
                $form = ActiveForm::begin([
                   'action' => ['contact'],
                   'options' => [
                       'enableAjaxValidation' => true,
                       'id'      => 'form-signup',
                       'class'   => 'php-form',
                       'validateOnBlur' => true
                   ]
                ]); 
           ?>
          <div class="row">
            <div class="col-md-6 form-group">
              <?= $form->field($model, 'name')->textInput(['placeholder' => 'Your Name'])->label(false) ?>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <?= $form->field($model, 'email')->textInput(['placeholder' => 'Your Email'])->label(false) ?>
            </div>
          </div>
          <div class="form-group mt-3">
            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject'])->label(false) ?>
          </div>
          <div class="form-group mt-3">
            <?= $form->field($model, 'body')->textarea(['rows' => 6,'placeholder' => 'Message'])->label(false) ?>
          </div>
          <div class="form-group mt-3">
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
          </div>
          <div class="text-center">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
          </div>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact Section --> 
  
</main>
<!-- End #main -->