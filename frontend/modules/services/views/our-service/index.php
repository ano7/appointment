<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MServices */ 

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main" data-aos="fade-in">
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="container">
      <h2>Courses</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  <!-- ======= Courses Section ======= -->
  <section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
      <div data-aos="zoom-in" data-aos-delay="100">
		<?= ListView::widget([
          'dataProvider' => $dataProvider,
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
  <!-- End Courses Section -->  
</main>
<!-- End #main -->
