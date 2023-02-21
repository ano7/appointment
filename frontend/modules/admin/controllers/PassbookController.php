<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\base\InvalidArgumentException;

/*****Start Model*******/
use common\models\TUserOrderDetail;
use common\models\ServiceAppointment;
/*****End Model*********/
/**
 * Passbook controller for the `admin` module
 */
class PassbookController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','credit-wallet'],
                'rules' => [
                    [
                        'actions' => ['index','view','credit-wallet'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
		$model = TUserOrderDetail::find()->where(array('User_ID' => Yii::$app->user->id,'Record_Status' => 'C'));
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_ASC
				)
			) 
		));
        return $this->render('index', [
            'dataProvider' => $dataProvider 
        ]);
    }
    /**
     * Lists all ServiceAppointment models.
     * @return mixed
     */
    public function actionView()
    {
		$model = ServiceAppointment::find()->where(array('Customer_ID' => Yii::$app->user->id,'Record_Status' => 'C'));
		
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_DESC
				)
			)
		));

		if(@Yii::$app->request->post('Appointment_Date')) {
			$model->andWhere('Appointment_Date= :Appointment_Date', [':Appointment_Date' => Yii::$app->request->post('Appointment_Date')]);
		}
        return $this->renderAjax('view', [
            'dataProvider' => $dataProvider ,
			'Appointment_Date' => Yii::$app->request->post('Appointment_Date')
        ]);
    }
    /**
     * Creates a new TUserOrderDetail model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreditWallet()
    {
        $model                           = new TUserOrderDetail();
        $transaction                     = \Yii::$app->db->beginTransaction();
        if (Yii::$app->request->post()) {
			    $model->User_ID           = Yii::$app->user->id;
				$model->Amount            = Yii::$app->request->post('Amount');
				$model->Transaction_Type  = 'CREDIT';
				$model->Available_Amount  = Yii::$app->admin->getAvailableAmount(Yii::$app->user->id)+Yii::$app->request->post('Amount');
				$model->Order_Status      = 'PAID';
				$model->Remarks           = 'Credit Wallet Amount';
			    $model->Record_Created_By = Yii::$app->user->id;
                $valid                    = $model->validate();
                if ($valid) {
                    try {
						if (!($flag = $model->save(false))) {
							$transaction->rollBack();
						}
                        if ($flag) { 
                            $transaction->commit();
                            $responseV = array(
                                'data' => array(
                                    'success' => true,
                                    'model' => null,
                                    'message' => 'Amount updated successfully.'
                                ),
                                'code' => 1 // Some semantic codes that you know them for yourself
                            );
							return $this->redirect(['index']);
                        } else {
                            $responseV = array(
                                'data' => array(
                                    'success' => false,
                                    'model' => null,
                                    'message' => 'An error occured.'
                                ),
                                'code' => 1 // Some semantic codes that you know them for yourself
                            );
                        }
                    }
                    catch (Exception $e) {
                        $transaction->rollBack();
                    }
                } else {
                    $ErrorInfo = $model->getErrors();
                    foreach ($ErrorInfo as $name => $error) {
                        if (!is_array($error)) {
                            continue;
                        }
                        foreach ($error as $e) {
                            $message = $e;
                            break;
                        }
                    }
                    $responseV = array(
                        'data' => array(
                            'success' => false,
                            'model' => null,
                            'message' => $message
                        ),
                        'code' => 1 // Some semantic codes that you know them for yourself
                    );
                }
            
        } else {
            $responseV = array(
                'data' => array(
                    'success' => false,
                    'model' => null,
                    'message' => 'Some validation error occur.Please re-check form.'
                ),
                'code' => 1 // Some semantic codes that you know them for yourself
            );
        }
        return json_encode($responseV);
    }
}
