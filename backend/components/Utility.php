<?php
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\caching\Cache;
use yii\helpers\ArrayHelper;
/********Start Include Models********/
use common\models\TUserInfo;
use common\models\MDistrict;
/********End Include Models********/
class Utility extends Component
{
    /**
    * Function to check  isSuperAdmin
    * @return true or false
    */
    public static function isSuperAdmin()
    {
        $model = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (array_key_exists("super_admin_role", $model)) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * Function to check  isAdmin  
    * @return true or false
    */
    public static function isAdmin()
    {
        $model = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (array_key_exists("admin_role", $model)) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * Function to check  isInstructor
    * @return true or false
    */
    public static function isInstructor()
    {
        $model = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (array_key_exists("instructor_role", $model)) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * Function to check  isCustomer
    * @return true or false
    */
    public static function isCustomer()
    {
		
        $model = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if (array_key_exists("customer_role", $model)) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * Function to get login user info 
    */
    public static function getInfo()
    {
		if(Yii::$app->utility->isSuperAdmin()) {
			$model = User::find()->where(array('id' => SUPER_ADMIN))->one();
		} elseif(Yii::$app->utility->isAdmin()) {
			$model = User::find()->where(array('id' => ADMIN))->one();
		} else  {
			$model = TUserInfo::find()->where(array('User_ID' => Yii::$app->user->getId()))->one();
		} 
		return $model;
	}
    /**
     * Function to get all districts to show in dropdown
     * @return String $od,$Name
     */
    public static function getDistrict($State_ID)
    {
        /**
         * Lists all MDistrict models.
         * Show in the create and search creteria
         */
        $model = ArrayHelper::map(MDistrict::find()->where(array(
		    'State_ID' => $State_ID,
            'Record_Status' => 'C'
        ))->orderBy(array('Name' => SORT_ASC))->all(), 'id', 'Name');
		
        return $model;  
    }
}