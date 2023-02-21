<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \use common\models\TUserInfo */

$this->title = Yii::t('app', 'Create Instructor');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="modal-header">
  <h4 class="modal-title">
    <?=$this->title?>
  </h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
</div>
<div class="modal-body">
  <?= $this->render('_form', array(
	'model' => $model,
	'picture' => $picture,
	't_user_info' => $t_user_info,
	'service_instructor_mapping' => $service_instructor_mapping,
  )) ?>
</div>

