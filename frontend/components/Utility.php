<?php
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\caching\Cache;
use yii\helpers\ArrayHelper;
/********Start Include Models********/
use common\models\TUserInfo;
/********End Include Models********/
class Utility extends Component
{
    /**
    * Function to get login user info 
    */
    public static function getInfo($User_ID)
    {
		$model = TUserInfo::find()->where(array('User_ID' => $User_ID))->one();	
		return $model;
	}
}