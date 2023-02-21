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
use common\models\ServiceAppointment;
/*****End Model*********/
/**
 * Order controller for the `admin` module
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','re-schedule-appointment'],
                'rules' => [
                    [
                        'actions' => ['index','view','re-schedule-appointment'],
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
		$model = ServiceAppointment::find()->where(array('Customer_ID' => Yii::$app->user->id,'Appointment_Date' => date('Y-m-d'),'Record_Status' => 'C'));
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
			
			$model->andWhere('Appointment_Date= :Appointment_Date', [':Appointment_Date' => date('Y-m-d',strtotime(Yii::$app->request->post('Appointment_Date')))]);
		}
        return $this->renderAjax('view', [
            'dataProvider' => $dataProvider ,
			'Appointment_Date' => date('Y-m-d',strtotime(Yii::$app->request->post('Appointment_Date')))
        ]);
    }
    /**
     * Update a ServiceAppointment model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionReScheduleAppointment()
    {
		$model = ServiceAppointment::find()->where(array('id' => Yii::$app->request->post('Appointment_ID')))->one();

        return $this->renderAjax('reschedule/index', [
		    'model' => $model ,
			'Appointment_ID' => Yii::$app->request->post('Appointment_ID')
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
			'Appointment_Date' => date('Y-m-d',strtotime(Yii::$app->request->post('Appointment_Date'))),
			'Instructor' => Yii::$app->utility->getInfo(Yii::$app->request->post('Instructor_ID')),
        ]);
    }
}
