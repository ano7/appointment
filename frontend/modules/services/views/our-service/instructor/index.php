<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\HtmlPurifier;
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<section id="trainers" class="trainers">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
         <h2>Instructor</h2>
         <p>Choose a Specialist</p>
      </div>
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
