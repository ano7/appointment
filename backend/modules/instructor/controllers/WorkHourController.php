<?php

namespace app\modules\instructor\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
/*****Start Model*******/
use common\models\MDay;
use common\models\MWorkhour;
use common\models\MTimeslot;
use common\models\MBreakhour;
use common\models\MReportingTime;
/*****End Model*********/


/**
 * WorkHour controller for the `instructor` module
 */
class WorkHourController extends Controller
{
    /**
     * Lists all MWorkhour => 'INSTRUCTOR' models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = MWorkhour::find()->alias('A')->joinWith('day AS B', true, 'INNER JOIN')->where(array('A.Instructor_ID' => Yii::$app->user->id,'A.Is_Break' => 'N','A.Record_Status' => 'C'));
		
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
		));
		
		$TimeSlot = Yii::$app->instructor->getTimeslot();
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Creates a new MBreakhour model.
     * If creation is successful, the browser will be show suucess message.
     * @return mixed
     */
    public function actionCreateBreak()
    {
        $model                            = new MBreakhour();
		$model->Day_ID                    = Yii::$app->request->post('Day_ID');
        return $this->renderAjax('break/index', array(
            'model'  => $model
        ));
    } 
    /**
     * Creates a new MBreakhour model.
     * If creation is successful, the browser will be show suucess message.
     * @return mixed
     */
    public function actionViewBreak()
    {
		$model = MBreakhour::find()->where(array('Instructor_ID' => Yii::$app->user->id,'Day_ID' => Yii::$app->request->post('Day_ID'),'Is_Break' => 'Y','Record_Status' => 'C'));
		

        $dataProvider = new ActiveDataProvider([
		    'query' => $model,
            'pagination' => false
        ]);
		
        return $this->renderAjax('break/view', array(
            'dataProvider'  => $dataProvider
        ));
    } 
    /**
     * Creates a new MBreakhour model.
     * If creation is successful, the browser will be show suucess message.
     * @return mixed
     */
    public function actionEndTimeSlot()
    {
        $model  = ArrayHelper::map(MTimeslot::find()->where(array('Start_Time' => Yii::$app->request->post('Break_Start_Time'),'Record_Status' => 'C'))->all(), 'End_Time', function($timeslot) {
		  $modelMReportingTime = MReportingTime::find()->where(array('id' => $timeslot->End_Time))->one();
		  return $modelMReportingTime->Time_Slot;
	    });
		
        return json_encode($model);
    } 
    /**
    * Submit MBreakhour model. 
    *
    * @return mixed
    */
    public function actionBreakSubmit()
    {

        $model                           = new MBreakhour();
        $transaction                     = \Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post())) {
		    	$model->Instructor_ID     = Yii::$app->user->id;
			    $model->Record_Created_By = Yii::$app->user->id;
				$model->Is_Break          = 'Y';
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
									'Day_ID' => $model->Day_ID,
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
    /**
    * Submit Signs user up. 
    *
    * @return mixed
    */
    public function actionSubmit()
    {
        $model                           = new MWorkhour();
        $transaction                     = \Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post())) {
			try {
				foreach($_POST['MWorkhour'] as $key => $value) {
					$model = MWorkhour::find()->where(array('id' => $value['id']))->one();
					$model->Start_Time = $value['Start_Time'];
					$model->End_Time   = $value['End_Time'];
					$valid  = $model->validate();
					if($valid) {
						if (!($flag = $model->save(false))) {
							$transaction->rollBack();
							break;
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
				}
				foreach($_POST['MBreakhour'] as $key => $MBreakhour) {
                    foreach($MBreakhour as $subkey => $value) {
						$model = MBreakhour::find()->where(array('id' => $value['id']))->one();
						$model->Start_Time = $value['Start_Time'];
						$model->End_Time   = $value['End_Time'];
						$valid  = $model->validate();
						if($valid) {
							if (!($flag = $model->save(false))) {
								$transaction->rollBack();
								break;
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
					}
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
