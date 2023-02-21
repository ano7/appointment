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
 * Calendar controller for the `instructor` module
 */
class CalendarController extends Controller
{
    /**
     * Lists all ServiceAppointment models.
     * @return mixed
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
            'dataProvider' => $dataProvider,
			'Appointment_Date' => date('Y-m-d')

        ]);
    }
    /**
     * Lists all ServiceAppointment models.
     * @return mixed
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

		if(@Yii::$app->request->post('Appointment_Date')) {
			$model->andWhere('Appointment_Date= :Appointment_Date', [':Appointment_Date' => Yii::$app->request->post('Appointment_Date')]);
		}
		if(Yii::$app->utility->isInstructor()) {
			$model->andWhere('Instructor_ID= :Instructor_ID', [':Instructor_ID' => Yii::$app->user->id]);
		}
        return $this->renderAjax('view', [
            'dataProvider' => $dataProvider ,
			'Appointment_Date' => Yii::$app->request->post('Appointment_Date')
        ]);
    }
}
