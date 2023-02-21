<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
  
  <!-- ======= Breadcrumbs ======= -->
  
  <div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2>
        <?=$this->title?>
      </h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  <!-- ======= Contact Section ======= -->
  <section id="data-form" class="data-form align-items-center">
    <div class="container" data-aos="fade-up">
      <div class="row mt-5">
        <div class="col-lg-8 mt-5 mt-lg-0">
          <?php 
			$form = ActiveForm::begin([
			   'action' => ['login'],
			   'options' => [
				   'enableAjaxValidation' => true,
				   'id'      => 'form-login',
				   'class'   => 'php-form',
				   'validateOnBlur' => true
			   ]
			]); 
          ?>
          <div class="form-group mt-3">
            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>
          </div>
          <div class="form-group mt-3">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
          </div>
          <?php /*?><div class="form-group mt-3">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
          </div><?php */?>
          <div style="color:#999;margin:1em 0"> If you forgot your password you can
            <?= Html::a('reset it', ['site/request-password-reset']) ?>
            . <br>
            Need new verification email?
            <?= Html::a('Resend', ['site/resend-verification-email']) ?>
          </div>
          <div class="text-center">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
          </div>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact Section --> 
  
</main>
<!-- End #main -->