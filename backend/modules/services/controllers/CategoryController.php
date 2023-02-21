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
use common\models\MCategory;
/*****End Model*********/

/**
 * Category controller for the `services` module
 */
class CategoryController extends Controller
{
    /**
     * Lists all MCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = MCategory::find()->where(array('Record_Status' => 'C'));
		$dataProvider = new ActiveDataProvider(array(
			'query' => $model,
			'pagination' => false,
			'sort' => array(
				'defaultOrder' => array(
					'Record_Created_On' => SORT_DESC
				)
			)
		));
        return $this->renderAjax('index', [
            'dataProvider' => $dataProvider
        ]);
    }
    /**
     * Creates a new MCategory model.
     * If creation is successful, the browser will be show suucess message.
     * @return mixed
     */
    public function actionCreateUpdate()
    {
        $model                            = new MCategory();
        return $this->renderAjax('create-update', array(
            'model' => $model,
        ));
    }
    /**
    * Submit MCategory model. 
    *
    * @return mixed
    */
    public function actionSubmit()
    {
        $model                           = new MCategory();
        $transaction                     = \Yii::$app->db->beginTransaction();
        if ($model->load(Yii::$app->request->post())) {
			    $model->Record_Created_By = Yii::$app->user->id;
                $valid                    = $model->validate();
                if ($valid) {
                    try {
						if (!($flag = $model->save(false))) {
							$transaction->rollBack();
						}
                        if ($flag) { 
                            $transaction->commit();
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
                    'message' => 'Some validation error occur.Please re-check form.'
                ),
                'code' => 1 // Some semantic codes that you know them for yourself
            );
        }
        return json_encode($responseV);
    }
}
