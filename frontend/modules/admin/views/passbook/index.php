<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\MServices */ 

$this->title = Yii::t('app', 'Passbook');
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
  <!-- ======= Breadcrumbs ======= -->
  
  <div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2>Account Balance & History</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
  </div>
  <!-- End Breadcrumbs --> 
  <!-- ======= Wallet Section ======= -->
  <section id="passbook" class="data-form">
    <div class="container aos-init aos-animate" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-3 order-1 order-lg-2 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
          <div class="info">
            <div class="address"> <i class="bi bi-wallet-fill"></i>
              <h4>₹<?=Yii::$app->admin->getAvailableAmount(Yii::$app->user->id)?></h4>
              <p>Your Wallet Balance</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
          <div class="row">
            <div class="col-lg-6 order-1 order-lg-2 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
				<?= $this->render('_form') ?>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100"> <br/>Have a Promocode? </div>
          </div>
        </div>
        <div class="col-lg-3 order-1 order-lg-2 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
          <div class="pricing btn-wrap text-right"> 
            <a href="javascript:void(0)" class="btn-buy" onclick="submitCreditWallet()">Add Money to Wallet</a> 
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Wallet Section --> 
  <!-- ======= Wallet Section ======= -->
  <section id="passbook" class="data-form">
    <div class="container aos-init aos-animate" data-aos="fade-up">
      <div class="section-title">
        <h2>Payment History</h2>
        <p>Your Payment History</p>
      </div>
      <div class="row">
        <div class="col-lg-12 order-1 order-lg-2 aos-init aos-animate" data-aos="fade-left" data-aos-delay="100">
		  <?= GridView::widget([
                  'dataProvider' => $dataProvider,
				  'rowOptions'=>function($model){
				    if($model->Transaction_Type == 'DEBIT'){ 
						return ['class' => 'table-danger'];
					}
				    elseif($model->Transaction_Type == 'CREDIT'){ 
						return ['class' => 'table-success'];
					}
				  },
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'Remarks',
					  'Transaction_Type',
                      [
					     'label' => 'Date',
						 'attribute' => 'Record_Created_On',
						 'format' => ['date', 'php:d F, Y h:i:s a']
                      ],  
					  'Amount',
					  'Available_Amount',
//                      ['header'=>'Action',
//                        'value'=> function($data)
//                            { 
//                               return  Html::button(Yii::t('app', ' {modelClass}', [
//                                        'modelClass' =>"View",
//                                    ]), 
//                                    ['class' => 'btn btn-xs btn-danger',
//                                    'onclick'=>"viewCustomer(".$data->id.")"]
//                                    );  
//                            },
//                        'format' => 'raw'
//                      ],
                  ],
            ]); ?>
        </div>
      </div>
    </div>
  </section>
  <!-- End Wallet Section --> 
</main>
<!-- End #main -->