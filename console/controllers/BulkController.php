<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
/******Start Model**********/
use backend\models\SignupForm;
use common\models\User;
use common\models\BranchDetails;
use common\models\BranchSlot;
/******End Model**********/
/**
 * StateController implements the CRUD actions for MBank model.
 */
class BulkController extends Controller
{
    /**
     * Lists all MBank models.
     * @return mixed
     */
    public function actionIndex()
    {
        $connection = Yii::$app->db;
        $sql        = $connection->createCommand("SELECT * FROM `m_bank`  WHERE is_status = 0")->queryAll();
        foreach ($sql as $key => $value) {
		  $getBranches = $connection->createCommand("SELECT * FROM bank_new WHERE bank_id = '".$value['id']."' AND is_status = 0")->queryAll();
			foreach($getBranches as $brankey=>$getBranch) {
				
			  $transaction = \Yii::$app->db->beginTransaction();
			  try {
				  $model           = new SignupForm();
				  $bank            = new BranchDetails();
				  $slot            = new BranchSlot();
				  $model->username = $getBranch['ifsc'];
				  $model->password = $getBranch['ifsc'];
				  $model->email    = 'support' . strtolower($getBranch['ifsc']) . '@gmail.com';
				  $bank->Category_ID       = $getBranch['type'];
				  $bank->Bank_ID           = $value['id'];
				  $bank->IFSC_Code         = $getBranch['ifsc'];
				  $bank->Name              = $getBranch['branch'];
				  $bank->Address           = $getBranch['address'];
				  $bank->District_ID       = $getBranch['district_id'];
				  if($getBranch['block_ID'] != 0) {
				   $bank->Block_ID          = $getBranch['block_ID'];
				  }
				  $bank->Contact_No        = substr($getBranch['mobile'], 0, 10);
				  $bank->Record_Created_By = 3;
				  $slot->Member_Per_Slot   = $getBranch['slot'];
				  $slot->Record_Created_By   = 3;
				  $valid                   = $model->validate() && $bank->validate() && $slot->validate();
				  if ($valid) {
					  if ($flag = $model->signup(false)) {
						  $getID         = User::find()->where(array(
							  'username' => $getBranch['ifsc']
						  ))->one();
						  $bank->User_ID = $getID->id;
						  if ($flag = $bank->save(false)) {
							  $slot->Branch_ID   = $bank->id;
							  if (!($flag = $slot->save(false))) {
								  $transaction->rollBack();
							  }
						  }
					  } else {
						  echo "<pre>";
						  print_r($model->getErrors());
						  die;
					  }
					  if ($flag) {
						  $auth       = Yii::$app->authManager;
						  $authorRole = $auth->getRole('branch_role');
						  $auth->assign($authorRole, $getID->id);
						  $transaction->commit();
					  }
				  } else {
					  echo "<pre>";
					  print_r($bank->getErrors());
						  print_r($model->getErrors());
						  die;
				  }
			  }
			  catch (Exception $e) {
				  $transaction->rollBack();
			  }
		  echo $getBranch['sr'].'<br/>';
		  $updateB = $connection->createCommand("UPDATE demo_test SET is_status = 1 WHERE sr = '".$getBranch['sr']."'")->execute();
		  }
		  echo $value['id'].'<br/>****Bank****<br/>';
		  $update = $connection->createCommand("UPDATE m_bank SET is_status = 1 WHERE id = '".$value['id']."'")->execute();
        }
        
    }
}