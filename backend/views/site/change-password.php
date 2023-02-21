<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('app', 'Change Password');
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
          <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <?= $form->field($model, 'oldPassword')->passwordInput() ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <?= $form->field($model, 'oldPassword')->passwordInput() ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <?= $form->field($model, 'retypePassword')->passwordInput() ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-1">
              <?= Html::submitButton(Yii::t('app', 'Change'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
            </div>
          </div>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
