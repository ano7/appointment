<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">


        <h1 class="logo me-auto"><a href="<?=Yii::$app->homeUrl?>"><img src="<?= Yii::$app->request->baseUrl?>/img/divya-logo.png" alt=""></a></h1>
   
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <?php
		NavBar::begin([
			'brandLabel' => '',
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-dark navbar-expand ',
			],
		]);
		$menuItems = [
			['label' => 'Home', 'url' => ['/site/index']],
			['label' => 'About', 'url' => ['/site/about']],
			['label' => 'Courses', 'url' => ['/services/our-service']],
			['label' => 'Trainers', 'url' => ['/instructor/our-instructor']],
			['label' => 'Price', 'url' => ['/wallet/default/index']],
			['label' => 'Contact', 'url' => ['/site/contact']],
		];
		if (Yii::$app->user->isGuest) {
			$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
			$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
		} 
		echo '<div class="menu-container">';
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right pull-right'],
			'items' => $menuItems,
		]);
		echo '</div>';
		NavBar::end();
		echo '<div class="col-lg-1 col-md-6 d-flex align-items-stretch">';
	    if (!Yii::$app->user->isGuest) { 
			NavBar::begin([
				'brandLabel' => '',
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-dark navbar-expand ',
				],
			]);
			$menuItemsSignin = [
				[
					'label' => 'My Account',
					'items' => [
						 ['label' => 'My Services', 'url' => ['/admin/order']],
						 '<div class="dropdown-divider"></div>', 
						 ['label' => 'Passbook', 'url' => ['/admin/passbook']],
						 '<div class="dropdown-divider"></div>', 
						 ['label' => 'Logout', 'url' => ['/site/logout']],
					],
				],
			];			
			echo '<div class="menu-container">';
			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right pull-right'],
				'items' => $menuItemsSignin,
			]);
			echo '</div></div>';
			NavBar::end();
	    } ?>
     <?php /*?><a href="courses.html" class="get-started-btn">Get Started</a><?php */?>


  </header><!-- End Header -->
  <?= $content ?>
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>About Us</h3>
            <p>Hi everyone! I’m Divya! I’m an Indian-origin Australian citizen and a native English speaker. My aim is to make my students more confident and fluent in speaking English. My lessons concentrate on developing reading, writing, and listening skills, as well as conversational English with a focus on vocabulary, grammar, and pronunciation. I'm also an IELTS, TOEFL, and Business English instructor</p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Information</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['site/index'])?>">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['site/about'])?>">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['services/our-service'])?>">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['site/index'])?>">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['site/index'])?>">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Popular Courses</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['/services/our-service/view', 'id' => '1'])?>">Spoken English</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['/services/our-service/view', 'id' => '2'])?>">Business English</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?=Url::toRoute(['/services/our-service/view', 'id' => '3'])?>">IELTS/TOFEL</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Contact Us</h4>
            <p>
              61 Wood Ave,<br>
              Holly Springs, NC 27540<br>
              United States <br><br>
              <strong>Phone:</strong> +1-202-555-0150<br>
              <strong>Email:</strong> info@divyaenglishacademy.com<br>
            </p>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Mentor</span></strong>. All Rights Reserved
        </div>

      </div>
      
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
