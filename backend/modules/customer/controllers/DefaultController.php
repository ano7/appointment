<?php

namespace app\modules\customer\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/*****Start Model*******/
use common\models\User;
use common\models\TUserInfo;
use common\models\MDocument;
use backend\models\SignupForm;
/*****End Model*********/


/**
 * Default controller for the `customer` module
 */
class DefaultController extends Controller
{
    /**
     * Lists all TUserInfo=>'CUSTOMER' models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = TUserInfo::find()->where(array('User_Type' => 'CUSTOMER','Record_Status' => 'C'));
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
            'dataProvider' => $dataProvider
        ]);
    }
    /**
     * Displays a single TUserInfo=>'CUSTOMER' model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
		$model = TUserInfo::find()->where(array('User_ID' => Yii::$app->request->post('User_ID'),'User_Type' => 'CUSTOMER','Record_Status' => 'C'))->one();
        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }
    /**
     * Creates a new TUserInfo=>'CUSTOMER' model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model                            = new SignupForm();
        $t_user_info                      = new TUserInfo();
        $picture                          = new MDocument();
        return $this->renderAjax('create', array(
            'model' => $model,
            'picture' => $picture,
            't_user_info' => $t_user_info,
        ));
    }
    /**
    * Submit Signs user up. 
    *
    * @return mixed
    */
    public function actionCustomerUserSignup()
    {
        $model                           = new SignupForm();
        $t_user_info                     = new TUserInfo();
        $picture                         = new MDocument();
        $transaction                     = \Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post()) && $t_user_info->load(Yii::$app->request->post())) {
            $picturefile = UploadedFile::getInstance($picture, 'Content');
            if ($picturefile) {
                $picturefile_contents       = file_get_contents($picturefile->tempName);
                $picture->Name              = $picturefile->name;
				$Content                    = base64_decode(base64_encode($picturefile_contents)); 
                $Picture                    = imagecreatefromstring($Content);
				ob_start (); 
				imagejpeg($Picture, null, 70);
				$Picture_Data               = ob_get_contents (); 
				$Size                       = ob_get_length();
				ob_end_clean ();
				$picture->Content           = base64_encode($Picture_Data);
				$picture->Type              = $picturefile->type;
                $picture->Size              = $Size;
                $picture->Record_Created_By = Yii::$app->user->id;
                $filevalid                  = $picture->validate();
                if ($filevalid) {
                    if (!($fileflag = $picture->save(false))) {
                        $transaction->rollBack();
                    }
                } else {
                    $fileflag = false;
                }
                if ($fileflag) {
                    $t_user_info->Picture_ID = (string) $picture->id;
                }
            } else {
                $fileflag = true;
            }
            if ($fileflag) {
				$model->username        = $model->email;
				$model->password        = '123456';
				$t_user_info->User_Type = 'CUSTOMER';
                $valid                  = $model->validate() && $t_user_info->validate();
                if ($valid) {
                    try {
                        if ($flag = $model->signup(false)) {
							$User_ID = Yii::$app->db->getLastInsertID();
                            $t_user_info->User_ID           = $User_ID;
                            $t_user_info->Record_Created_By = Yii::$app->user->id;
							if (!($flag = $t_user_info->save(false))) {
                                $transaction->rollBack();
  							}
                        }
                        if ($flag) {
                            $transaction->commit();
							return $this->redirect(['index']);
                            $auth       = Yii::$app->authManager;
                            $authorRole = $auth->getRole('customer_role');
                            $auth->assign($authorRole, $User_ID);
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
                    $ErrorInfo = $model->getErrors();
                    if (empty($ErrorInfo)) {
                        $ErrorInfo = $t_user_info->getErrors();
                    }
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
                        'message' => 'Please upload Picture to submit form.'
                    ),
                    'code' => 0 // Some semantic codes that you know them for yourself
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
}
