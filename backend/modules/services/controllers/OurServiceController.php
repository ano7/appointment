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
/*****End Model*********/


/**
 * Our Service controller for the `services` module
 */
class OurServiceController extends Controller
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
    public function actionView($id)
    {
		$model = MServices::find()->where(array('id' => $id,'Record_Status' => 'C'))->one();
        return $this->render('view', [ 
            'model' => $model,
        ]);
    }
}
