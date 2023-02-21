<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MWorkhour */ 

$this->title = Yii::t('app', 'Work Hour');
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
		<?php 
            $form = ActiveForm::begin([
               'action' => ['work-hour/submit'],
               'options' => [
                   'enableAjaxValidation' => true,
                   'id'      => 'create_update_workhour',
                   'class'   => 'create_update_workhour',
                   'validateOnBlur' => true
               ]
            ]); 
          ?>
		  <?= ListView::widget([
              'dataProvider' => $dataProvider,
              'itemOptions' => ['tag' => null],
              'itemView' => '_day',
              'emptyText' => '',
              'summary'  => '',
              'options' => [
                  'class' => '',
                  'id' => false
              ],
              'viewParams' => [
                'fullView' => true,
				'form' => $form,
              ],
          ]); ?>
         <?= Html::Button('Submit', ['class' => 'btn btn-primary btn-block','onclick' => 'submitWorkHourData()']) ?>
         <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade show" id="break-info" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content"> </div>
  </div>
</div>
