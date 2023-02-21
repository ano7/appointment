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
use common\models\TUserOrderDetail;
/********End Include Models********/

class Admin extends Component 
{
    /**
     * Function to get Available Amount.
     */
    public static function getAvailableAmount($User_ID)
    {
		/**
		 * Lists all TUserOrderDetail models.
		 * Show in the create and search creteria
		 */		
		$TUserOrderDetailCredit   = TUserOrderDetail::find()->where(array('User_ID' => $User_ID,'Transaction_Type' => 'CREDIT','Record_Status' => 'C'))->sum('Amount');
		
	    $TUserOrderDetailDebit    = TUserOrderDetail::find()->where(array('User_ID' => $User_ID,'Transaction_Type' => 'DEBIT','Record_Status' => 'C'))->sum('Amount');
		
        $TUserOrderDetailCredit   = ($TUserOrderDetailCredit != '') ? $TUserOrderDetailCredit : 0;
		
		$TUserOrderDetailDebit    = ($TUserOrderDetailDebit != '') ? $TUserOrderDetailDebit : 0;
		
	    return $TUserOrderDetailCredit - $TUserOrderDetailDebit;
    }
}