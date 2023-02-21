<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
  
  <!-- ======= Breadcrumbs ======= -->
  
  <div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2>
        <?= Html::encode($this->title) ?>
      </h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  
  <!-- ======= Contact Section ======= -->
  <section id="data-form" class="data-form">
    <div class="container" data-aos="fade-up">
      <div class="row mt-5">
        <div class="col-lg-8 mt-5 mt-lg-0">
          <?php 
			$form = ActiveForm::begin([
			   'action' => ['signup'],
			   'options' => [
				   'enableAjaxValidation' => true,
				   'id'      => 'form-signup',
				   'class'   => 'php-form',
				   'validateOnBlur' => true
			   ]
			]); 
          ?>
          <div class="form-group mt-3">
            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>
          </div>
          <div class="form-group mt-3">
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
          </div>
          <div class="form-group mt-3">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
          </div>          
          <div class="text-center">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
          </div>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact Section --> 
  
</main>
<!-- End #main -->
