<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MServices */ 

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">
            <?=$this->title?>
          </h3>
        </div>
        <div class="card-body">
            <?= ListView::widget([
			  'dataProvider' => $dataProvider,
			  'itemOptions' => ['tag' => null],
			  'itemView' => '_service',
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
    </div>
  </div>
</div>
<div class="modal fade show" id="category-info" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content"> </div>
  </div>
</div>
<div class="modal fade show" id="service-info" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content"> </div>
  </div>
</div>
