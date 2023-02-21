<?php

namespace console\controllers;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class CronController extends Controller {

    public function actionTest() {
		$connection = Yii::$app->db;
		$getCity = $connection->createCommand("SELECT * FROM m_city WHERE is_status = 0")->queryAll();
		foreach ($getCity as $city) {
		$getState = $connection->createCommand("SELECT DISTINCT  mc.City_Id, sm.village,sm.officename,sm.pincode
FROM m_city mc
INNER JOIN state_master sm ON sm.subdistrict = mc.Name WHERE mc.City_Id = '".$city['City_Id']."'")->queryAll();
        foreach($getState as $value) {
		   $insert = $connection->createCommand("INSERT INTO m_village (City_Id,Name,OfficeName,PinCode,Record_Created_By) VALUES ('".$value['City_Id']."','".$value['village']."','".$value['officename']."','".$value['pincode']."','1')")->execute();
		}
		 $update = $connection->createCommand("UPDATE m_city SET is_status = 1 WHERE City_Id = '".$city['City_Id']."'")->execute();
		 echo $city['City_Id'].'<br/>';
	  }
	  
    }
}