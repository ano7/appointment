<?php

namespace app\modules\appointment\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/*****Start Model*******/
use common\models\ServiceAppointment;
/*****End Model*********/

/**
 * Default controller for the `appointment` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
		$model = ServiceAppointment::find()->where(array('Appointment_Date' => date('Y-m-d'),'Record_Status' => 'C'));
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_DESC
				)
			)
		));
		if(Yii::$app->utility->isInstructor()) {
			$model->andWhere('Instructor_ID= :Instructor_ID', [':Instructor_ID' => Yii::$app->user->id]);
		}
        return $this->render('index', [
            'dataProvider' => $dataProvider 
        ]);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionView()
    {
		$model = ServiceAppointment::find()->where(array('Record_Status' => 'C'));
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_DESC
				)
			)
		));
		if(Yii::$app->utility->isInstructor()) {
			$model->andWhere('Instructor_ID= :Instructor_ID', [':Instructor_ID' => Yii::$app->user->id]);
		}
		if(Yii::$app->request->post('Status') == 'Previous') {
			$model->andWhere('Appointment_Date < :Appointment_Date', [':Appointment_Date' => date('Y-m-d')]);
		} elseif(Yii::$app->request->post('Status') == 'Today') {
			$model->andWhere('Appointment_Date = :Appointment_Date', [':Appointment_Date' => date('Y-m-d')]);
		} elseif(Yii::$app->request->post('Status') == 'Upcoming') {
			$model->andWhere('Appointment_Date > :Appointment_Date', [':Appointment_Date' => date('Y-m-d')]);
		}
        return $this->renderAjax('view', [
            'dataProvider' => $dataProvider,
			'Status' => Yii::$app->request->post('Status')
        ]);
    }
    /**
    * Submit ServiceAppointment model. 
    *
    * @return mixed
    */
    public function actionSubmit()
    {
        $model                           = ServiceAppointment::find()->where(array('id' => Yii::$app->request->post('Appointment_ID'),'Record_Status' => 'C'))->one();
        $transaction                     = \Yii::$app->db->beginTransaction();
        if (Yii::$app->request->post()) {
			    $model->Appointment_Status = Yii::$app->request->post('Appointment_Status');
			    $model->Record_Updated_By  = Yii::$app->user->id;
                $valid                     = $model->validate();
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
