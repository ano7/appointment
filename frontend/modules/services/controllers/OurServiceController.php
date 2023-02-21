<?php

namespace app\modules\services\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
/*****Start Model*******/
use common\models\MServices;
use common\models\TUserInfo;
use common\models\TUserOrderDetail;
use common\models\ServiceAppointment;
use common\models\ServiceInstructorMapping;
/*****End Model*********/


/**
 * Our Service controller for the `services` module
 */
class OurServiceController extends Controller
{
    /**
     * Lists all MServices models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = MServices::find()->where(array('Record_Status' => 'C'));
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_DESC
				)
			)
		));
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
    /**
     * Displays a single MServices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model                         = MServices::find()->where(array('id' => $id,'Record_Status' => 'C'))->one();
		
        return $this->render('view', [ 
            'model' => $model,
        ]);
    }
    /** 
     * Lists all TUserInfo=>'INSTRUCTOR' models.
     * @return mixed
     */
    public function actionInstructor()
    {
		$model = ServiceInstructorMapping::find()->where(array('Service_ID' => Yii::$app->request->post('Service_ID'),'Record_Status' => 'C'));
		
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_DESC
				)
			)
		));
		 
        return $this->renderAjax('instructor/index', [ 
			'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all MTimeslot models.
     * @return mixed
     */
    public function actionTimeSlot()
    {
        $dataProvider = Yii::$app->service->getInstructorWorkingHour(Yii::$app->request->post('Instructor_ID'),date('Y-m-d',strtotime(Yii::$app->request->post('Appointment_Date'))));
		 
        return $this->renderAjax('time-slot/index', [ 
			'dataProvider' => $dataProvider,
			'Appointment_Date' => Yii::$app->request->post('Appointment_Date'),
			'Instructor' => Yii::$app->utility->getInfo(Yii::$app->request->post('Instructor_ID')),
        ]);
    }
    /**
    * Submit MCategory model. 
    *
    * @return mixed
    */
    public function actionSubmit()
    {
        $model                 = new ServiceAppointment();
        $modelTUserOrderDetail = new TUserOrderDetail();
        $transaction           = \Yii::$app->db->beginTransaction();
        if (Yii::$app->request->post()) {
            $MServices          = MServices::find()->where(array(
                'id' => Yii::$app->request->post('Service_ID'),
                'Record_Status' => 'C'
            ))->one();
            $getAvailableAmount = Yii::$app->admin->getAvailableAmount(Yii::$app->user->id) - $MServices->Price;
            if ($getAvailableAmount > 0) {
                $model->Customer_ID                       = Yii::$app->user->id;
                $model->Instructor_ID                     = Yii::$app->request->post('Instructor_ID');
                $model->Service_ID                        = Yii::$app->request->post('Service_ID');
                $model->Timeslot_ID                       = Yii::$app->request->post('Timeslot_ID');
                $model->Day_ID                            = date('w', strtotime(Yii::$app->request->post('Appointment_Date')));
                $model->Appointment_Date                  = Yii::$app->request->post('Appointment_Date');
                $model->Duration_Val                      = 1;
                $model->Record_Created_By                 = Yii::$app->user->id;
                /**
                 * Creates a new TUserOrderDetail model.
                 */
                $modelTUserOrderDetail->User_ID           = Yii::$app->user->id;
                $modelTUserOrderDetail->Amount            = $MServices->Price;
                $modelTUserOrderDetail->Transaction_Type  = 'DEBIT';
                $modelTUserOrderDetail->Available_Amount  = $getAvailableAmount;
                $modelTUserOrderDetail->Order_Status      = 'PAID';
                $modelTUserOrderDetail->Remarks           = $MServices->Name;
                $modelTUserOrderDetail->Record_Created_By = Yii::$app->user->id;
                
                $valid = $model->validate() && $modelTUserOrderDetail->validate();
                if ($valid) {
                    try {
                        if ($flag = $model->save(false)) {
                            if (!($flag = $modelTUserOrderDetail->save(false))) {
                                $transaction->rollBack();
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['index']);
                            $responseV = array(
                                'data' => array(
                                    'success' => true,
                                    'model' => null,
                                    'message' => 'Record updated successfully.'
                                ),
                                'code' => 1 // Some semantic codes that you know them for yourself
                            );
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
                    if (empty($ErrorInfo)) {
                        $ErrorInfo = $modelTUserOrderDetail->getErrors();
                    }
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
                        'message' => 'You have insufficent wallet amount to process this request please recharge your wallet to enjoy services.'
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
    /**
    * Submit MCategory model. 
    *
    * @return mixed
    */
    public function actionReScheduleSubmit()
    {
		$model                 = ServiceAppointment::find()->where(array('id' => Yii::$app->request->post('Appointment_ID')))->one();
        $transaction           = \Yii::$app->db->beginTransaction();
        if (Yii::$app->request->post()) {
		    	$model->Timeslot_ID                       = Yii::$app->request->post('Timeslot_ID');
                $model->Day_ID                            = date('w', strtotime(Yii::$app->request->post('Appointment_Date')));
                $model->Appointment_Date                  = date('Y-m-d',strtotime(Yii::$app->request->post('Appointment_Date')));
				$model->Appointment_Status                = 'PENDING';
				$model->Record_Updated_By                 = Yii::$app->user->id;
                $valid = $model->validate();
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
                                    'message' => 'Record updated successfully.'
                                ),
                                'code' => 1 // Some semantic codes that you know them for yourself
                            );
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
                    if (empty($ErrorInfo)) {
                        $ErrorInfo = $modelTUserOrderDetail->getErrors();
                    }
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
