<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */ 

$this->title = Yii::t('app', 'Our Instructor');
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main" data-aos="fade-in">
  <!-- ======= Breadcrumbs ======= -->
  
  <div class="breadcrumbs">
    <div class="container">
      <h2>Trainers</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  <!-- ======= Trainers Section ======= -->
  <section id="trainers" class="trainers">
    <div class="container" data-aos="fade-up">
      <div data-aos="zoom-in" data-aos-delay="100">
        <?= ListView::widget([
			  'dataProvider' => $dataProvider,
			  'itemOptions' => ['tag' => null],
			  'itemView' => '_instructor',
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
      </div>
    </div>
  </section>
  <!-- End Trainers Section --> 
</main>
<!-- End #main -->