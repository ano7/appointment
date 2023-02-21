<?php

namespace app\modules\services\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/*****Start Model*******/
use common\models\MServices;
use common\models\MDocument;
/*****End Model*********/


/**
 * Default controller for the `services` module
 */
class DefaultController extends Controller
{
    /**
     * Lists all MServices models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = MServices::find()->where(array('Record_Status' => 'C'));
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
     * Displays a single MServices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
		$model = MServices::find()->where(array('Record_Status' => 'C'))->one();
        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }
    /**
     * Creates a new MServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateUpdate()
    {
		$model  = MServices::find()->where(array('id' => Yii::$app->request->post('SERVICE_ID'),'Record_Status' => 'C'))->one();
		if(!$model) {
			$model  = new MServices();
		}
        $picture                          = new MDocument();
        return $this->renderAjax('create-update', array(
            'model' => $model,
            'picture' => $picture,
        ));
    }
    /**
    * Submit MServices model. 
    *
    * @return mixed
    */
    public function actionSubmit()
    {
		if(@$_POST['MServices']['id']) {
			$model  = MServices::find()->where(array('id' => $_POST['MServices']['id'],'Record_Status' => 'C'))->one();
		} else {
            $model                           = new MServices();
		}
        $picture                         = new MDocument();
        $transaction                     = \Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post())) {
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
                    $model->Picture_ID = (string) $picture->id;
                }
            } else {
                $fileflag = true;
            }
            if ($fileflag) {
				$model->Start_Date        = date("Y-m-d", strtotime($model->Start_Date));
				$model->End_Date          = date("Y-m-d", strtotime($model->End_Date));
				$model->Record_Created_By = Yii::$app->user->id;
                $valid                    = $model->validate();
                if ($valid) {
                    try {
						if (!($flag = $model->save(false))) {
							$transaction->rollBack();
						}
                        if ($flag) {
                            $transaction->commit();
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
