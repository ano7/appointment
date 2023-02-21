<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MCategory */ 

$this->title = Yii::t('app', 'Category');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal-header">
  <h4 class="modal-title">
    <button type="button" class="btn btn-info" onclick="addUpdateCategory()"><i class="fas fa-plus"></i> Add Category </button>
  </h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
  <?= GridView::widget([
		  'dataProvider' => $dataProvider,
		  'columns' => [
			  ['class' => 'yii\grid\SerialColumn'],
			  'Name',
			  ['header'=>'Action',
				'value'=> function($data)
					{ 
					   return  Html::button(Yii::t('app', ' {modelClass}', [
								'modelClass' =>"Delete",
							]), 
							['class' => 'btn btn-xs btn-danger',
							'onclick'=>"deleteCategory(".$data->id.")"]
							);  
					},
				'format' => 'raw'
			  ],
		  ],
	]); ?>
</div>
