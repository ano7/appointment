<?php

namespace app\modules\instructor\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
/*****Start Model*******/
use common\models\Model;
use common\models\User;
use common\models\MDocument;
use common\models\MWorkhour;
use common\models\TUserInfo;
use backend\models\SignupForm;
use common\models\ServiceInstructorMapping;
/*****End Model*********/


/**
 * Default controller for the `instructor` module
 */
class DefaultController extends Controller
{
    /**
     * Lists all TUserInfo=>'INSTRUCTOR' models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = TUserInfo::find()->where(array('User_Type' => 'INSTRUCTOR','Record_Status' => 'C'));
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
     * Displays a single TUserInfo=>'INSTRUCTOR' model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
		$model = TUserInfo::find()->where(array('User_ID' => Yii::$app->request->post('User_ID'),'User_Type' => 'INSTRUCTOR','Record_Status' => 'C'))->one();
        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }
    /**
     * Creates a new TUserInfo=>'INSTRUCTOR' model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateUpdate()
    {
		$t_user_info  = TUserInfo::find()->where(array('id' => Yii::$app->request->post('User_ID'),'Record_Status' => 'C'))->one();
		if(!$t_user_info) {
			$t_user_info                = new TUserInfo();
			$model                      = new SignupForm();
			$service_instructor_mapping = new ServiceInstructorMapping();
		} else {
			$model                      = User::find()->where(array('id' => $t_user_info->User_ID))->one();
			$service_instructor_mapping = ServiceInstructorMapping::find()->where(array('Instructor_ID' => $t_user_info->User_ID,'Record_Status' => 'C'))->one();

		}
        $picture                          = new MDocument();
        return $this->renderAjax('create-update', array(
            'model' => $model,
            'picture' => $picture,
            't_user_info' => $t_user_info,
			'service_instructor_mapping' => $service_instructor_mapping,
        ));
    }
    /**
    * Submit Signs user up. 
    *
    * @return mixed
    */
    public function actionInstructorUserSignup()
    {
		if(@$_POST['TUserInfo']['id']) {
			$t_user_info                 = TUserInfo::find()->where(array('id' => $_POST['TUserInfo']['id'],'Record_Status' => 'C'))->one();
			$model                       = User::find()->where(array('id' => $t_user_info->User_ID))->one();
			$picture                     = MDocument::find()->where(array('id' => $t_user_info->Picture_ID,'Record_Status' => 'C'))->one();
			$service_instructor_mapping  = ServiceInstructorMapping::find()->where(array('Instructor_ID' => $t_user_info->User_ID,'Record_Status' => 'C'))->one();
		} else {
			$t_user_info                 = new TUserInfo();
			$model                       = new SignupForm();
			$service_instructor_mapping  = new ServiceInstructorMapping();
			$picture                     = new MDocument();
		}
        $transaction                     = \Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post()) && $t_user_info->load(Yii::$app->request->post()) && $service_instructor_mapping->load(Yii::$app->request->post())) {
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
				if ($t_user_info->isNewRecord) {
					$model->username        = $model->email;
					$model->password        = '123456';
					$t_user_info->User_Type = 'INSTRUCTOR';
					$valid                  = $model->validate() && $t_user_info->validate();
				} else {
					$valid                  = $t_user_info->validate();
				}
                if ($valid) {
                    try {
						if ($t_user_info->isNewRecord) {
							if ($flag = $model->signup(false)) {
								$User_ID = Yii::$app->db->getLastInsertID();
								$t_user_info->User_ID           = $User_ID;
								$t_user_info->Record_Created_By = Yii::$app->user->id;
								if ($flag = $t_user_info->save(false)) {
									foreach($_POST['ServiceInstructorMapping']['Service_ID'] as $key=>$mapping) {
										if(@$mapping) {
											$service_instructor = new ServiceInstructorMapping();
											$service_instructor->Service_ID    = $mapping;
											$service_instructor->Instructor_ID = $User_ID;
											$service_instructor->Record_Created_By = Yii::$app->user->id;
											if (!($flag = $service_instructor->save(false))) {
												$transaction->rollBack();
												break;
											}
										}
									} 
									for ($day = 1; $day <= 7; $day++) {
										$m_workhour = new MWorkhour();
										$m_workhour->Instructor_ID     = $User_ID;
										$m_workhour->Day_ID            = $day;
										$m_workhour->Record_Created_By = Yii::$app->user->id;
										if (!($flag = $m_workhour->save(false))) {
											$transaction->rollBack();
											break;
										}
									} 
								}
							}
					    } else {
							if ($flag = $t_user_info->save(false)) {
								$oldIDs                         = ServiceInstructorMapping::find()->select(['Service_ID'])->where(array('Instructor_ID' => $t_user_info->User_ID,'Record_Status' => 'C'))->all();
                                $modelsServiceInstructorMapping = $_POST['ServiceInstructorMapping']['Service_ID'];
								
								$newIDs                         = array_diff($modelsServiceInstructorMapping,array_column($oldIDs, 'Service_ID'));
								$deletedIDs                     = array_diff(array_column($oldIDs, 'Service_ID'), $modelsServiceInstructorMapping); 
								$deletedIDs                     = implode( "', '", $deletedIDs );
								if(@$deletedIDs) {
								    $rows_volunteer             = ServiceInstructorMapping::updateAll(array('Record_Status' => 'D','Record_Updated_By' => Yii::$app->user->identity->id),'Instructor_ID = '.$t_user_info->User_ID.' AND Service_ID IN ('.$deletedIDs.')');
								}
								foreach($newIDs as $key=>$newID) {
									if(@$newID) {
										$service_instructor = new ServiceInstructorMapping();
										$service_instructor->Service_ID    = $newID;
										$service_instructor->Instructor_ID = $t_user_info->User_ID;
										$service_instructor->Record_Created_By = Yii::$app->user->id;
										if (!($flag = $service_instructor->save(false))) {
											$transaction->rollBack();
											break;
										}
									}
								}  
							}
						}
                        if ($flag) {
                            $transaction->commit();
							if ($t_user_info->isNewRecord) {
								$auth       = Yii::$app->authManager;
								$authorRole = $auth->getRole('instructor_role');
								$auth->assign($authorRole, $User_ID);
							}
							return $this->redirect(['index']);
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
                    if (empty($ErrorInfo)) {
                        $ErrorInfo = $service_instructor_mapping->getErrors();
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
