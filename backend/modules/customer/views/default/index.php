<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */ 

$this->title = Yii::t('app', 'Students');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">
            <?=$this->title?>
          </h4>
        </div>
        <div class="card-body">
          <div id="sub-header" class="text-right">
            <button type="button" class="btn btn-info" onclick="showCustomerInfo()"><i class="fas fa-plus"></i> Add Student </button>
          </div>
        </div>
        <div class="card-body">
		  <?= GridView::widget([
                  'dataProvider' => $dataProvider,
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'Name',
					  'user.email',
					  'Contact_No',
					  'gender.Name',
                      ['header'=>'Action',
                        'value'=> function($data)
                            { 
                               return  Html::button(Yii::t('app', ' {modelClass}', [
                                        'modelClass' =>"View",
                                    ]), 
                                    ['class' => 'btn btn-xs btn-danger',
                                    'onclick'=>"addUpdateCustomerInfo(".$data->id.")"]
                                    );  
                            },
                        'format' => 'raw'
                      ],
                  ],
            ]); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" id="customer-info" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content"> </div>
  </div>
</div>
