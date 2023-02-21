<?php

namespace app\components;
use Yii;
use yii\caching\Cache;
use yii\db\Expression;
use yii\base\Exception;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
/********Start Include Models********/
use common\models\MBreakhour;
use common\models\MReportingTime;
use common\models\ServiceInstructorMapping;
/********End Include Models********/

class Instructor extends Component
{
    /**
     * Function to get Instructor Services.
     */
    public static function getInstructorServices($Instructor_ID)
    {
		/**
		 * Lists all ServiceInstructorMapping models.
		 * Show in the create and search creteria
		 */
		$model      = ServiceInstructorMapping::find()->select(['Service_ID'])->where(array('Instructor_ID' => $Instructor_ID,'Record_Status' => 'C'))->asArray()->all();
		$model      = array_column($model, 'Service_ID');
		
	    return $model;
    }
    /**
     * Function to get all Timeslot.
     */
    public static function getTimeslot()
    {
		/**
		 * Lists all MReportingTime models.
		 * Show in the create and search creteria
		 */
		$model      = ArrayHelper::map(MReportingTime::find()->where(array('Type' => 'STRAT_END','Record_Status' => 'C'))->all(),'id','Name');
		
	    return $model;
    }
    /**
     * Function to get Instructor Break.
     */
    public static function getBreak($Day_ID)
    {
		/**
		 * Lists all MBreakhour models.
		 * Show in the create and search creteria
		 */
		$model = MBreakhour::find()->where(array('Instructor_ID' => Yii::$app->user->id,'Day_ID' => $Day_ID,'Is_Break' => 'Y','Record_Status' => 'C'));
		

        $dataProvider = new ActiveDataProvider([
		    'query' => $model,
            'pagination' => false
        ]);
		
	    return $dataProvider;
    }
}