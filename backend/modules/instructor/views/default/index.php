<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\TUserInfo */ 

$this->title = Yii::t('app', 'Instructor');
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
            <button type="button" class="btn btn-info" onclick="addUpdateInstructorInfo()"><i class="fas fa-plus"></i> Add Instructor </button>
          </div>
        </div>
        <div class="card-body">
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
    </div>
  </div>
</div>
<div class="modal fade show" id="instructor-info" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content"> </div>
  </div>
</div>
