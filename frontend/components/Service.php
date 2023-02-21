<?php

namespace app\components;
use Yii;
use yii\caching\Cache;
use yii\db\Expression;
use yii\base\Exception;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
/********Start Include Models********/
use common\models\MTimeslot;
use common\models\MWorkhour;
/********End Include Models********/

class Service extends Component
{
    /**
     * Function to get Instructor Working Hour.
     */
    public static function getInstructorWorkingHour($Instructor_ID,$Appointment_Date)
    {
		/**
		 * Lists all MWorkhour models.
		 * Show in the create and search creteria
		 */
		$Day_ID      = date('w', strtotime($Appointment_Date));
		
		$MWorkhour   = MWorkhour::find()->where(array('Instructor_ID' => $Instructor_ID,'Day_ID' => $Day_ID,'Record_Status' => 'C'))->one();
		
	    $model       = Yii::$app->service->getTimeSlot($Instructor_ID,$Appointment_Date,$Day_ID,$MWorkhour->Start_Time,$MWorkhour->End_Time);
		
	    return $model;
    }
    /**
     * Function to get Time Slot.
     */
    public static function getTimeSlot($Instructor_ID,$Appointment_Date,$Day_ID,$Start_Time,$End_Time)
    {			
	   $model      = MTimeslot::find()->alias('A')->leftJoin('service_appointment AS B', 'B.Timeslot_ID = A.id  AND B.Instructor_ID = '.$Instructor_ID.' AND Appointment_Date = "'.$Appointment_Date.'" AND Day_ID = '.$Day_ID.' AND Appointment_Status IN ("PENDING","APPROVED") AND  B.Record_Status = "C"')
		 ->where(['A.Type' => 'FULL','A.Record_Status' => 'C'])->andWhere(['>=','Start_Time',$Start_Time])->andWhere(['<=','End_Time',$End_Time])->andWhere(['IS','B.Timeslot_ID',NULL])->all();
	   
	   $result = []; 
	   
       foreach($model as $key=>$value) {
		     
			 $modelMWorkHour = MWorkhour::find()->where(array('Instructor_ID' => $Instructor_ID,'Day_ID' => $Day_ID,'Is_Break' => 'Y','Record_Status' => 'C'))
			 ->andWhere(['>=','Start_Time',$value->Start_Time])->andWhere(['<=','End_Time',$value->End_Time])->one();
			 
			 if($modelMWorkHour) {	 
				 $timeslot  = [$value->Start_Time,$value->End_Time];
				 $breakslot = [$modelMWorkHour->Start_Time,$modelMWorkHour->End_Time];
				 $a = array_merge($timeslot,$breakslot);
				 $b = array_unique(array_diff_assoc($a,array_unique($a)));
				 $b = array_values($b);
				 $fields = array_flip($a);
				 foreach($b as $k=>$v) {
					 unset($fields[$v]);
				 }
				 $fields = array_flip($fields);
				 $fields = array_values($fields);
				 if($fields) {
					 sort($fields);
					 $getTimeSlotInfo = Yii::$app->service->getTimeSlotInfo($fields[0],$fields[1]);
					 $res['id'] = $getTimeSlotInfo->id;
					 $res['Start_Time'] = $getTimeSlotInfo['startTime']->Time_Slot;
					 $res['End_Time'] = $getTimeSlotInfo['endTime']->Time_Slot;
					 $result[] = $res;	 
				 }
			 } else {
				 $res['id'] = $value->id;
				 $res['Start_Time'] = $value['startTime']->Time_Slot;
				 $res['End_Time'] = $value['endTime']->Time_Slot;			
				 $result[] = $res;	 		 
			 }
	    }
 
        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
            'pagination' => false
        ]);
		
	    return $dataProvider;	   
    }
    /**
     * Function to get Time Slot ID.
     */
    public static function getTimeSlotInfo($Start_Time,$End_Time)
    {
       $model      = MTimeslot::find()->where(array('Start_Time' => $Start_Time,'End_Time' => $End_Time,'Type' => 'PARTIAL','Record_Status' => 'C'))->one();
	   
	   return $model;
	}
    /**
     * Function to get Time Slot.
     */
    public static function getTimeSlotBK($Instructor_ID,$Appointment_Date,$Day_ID,$Start_Time,$End_Time)
    {
		/**
		 * Lists all MTimeslot models.
		 * Show in the create and search creteria
		 */
		$model      = MTimeslot::find()->alias('A')->leftJoin('service_appointment AS B', 'B.Timeslot_ID = A.id  AND B.Instructor_ID = '.$Instructor_ID.' AND Appointment_Date = "'.$Appointment_Date.'" AND Day_ID = '.$Day_ID.' AND Appointment_Status IN ("PENDING","APPROVED") AND  B.Record_Status = "C"')
		 ->where(['A.Type' => 'FULL','A.Record_Status' => 'C'])->andWhere(['>=','Start_Time',$Start_Time])->andWhere(['<=','End_Time',$End_Time])->andWhere(['IS','B.Timeslot_ID',NULL]);
		 
		 
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_DESC
				)
			)
		));
         
	    return $dataProvider;
    } 
}