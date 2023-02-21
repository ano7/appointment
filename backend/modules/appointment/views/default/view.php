<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/******Start Model*******/
   
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */   
?>
<?php
if($dataProvider->getTotalCount() > 0) { 
?>
<table class="table">
    <thead>
      <tr>
        <th class="text-center" scope="col">Date</th>
        <th scope="col" colspan="2">Instructor</th>
        <th scope="col">Customer</th>
        <th class="text-center" scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      <?= ListView::widget([
          'dataProvider' => $dataProvider,
          'itemOptions' => ['tag' => null],
          'itemView' => '_listing',
          'emptyText' => '',
          'summary'  => '',
          'options' => [
              'class' => 'row',
              'id' => false
          ],
          'viewParams' => [
            'fullView' => true,
			'Status'   => $Status
          ],
         ]); ?>
    </tbody>
</table>
<?php } else { ?>
  <div class="alert alert-danger" role="alert"> I’m sorry, we can’t find any appointment in this Criteria.</div>
<?php } ?>