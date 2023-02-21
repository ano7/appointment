<?php

namespace app\modules\instructor\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/*****Start Model*******/
use common\models\TUserInfo;
/*****End Model*********/


/**
 * OurInstructor controller for the `instructor` module
 */
class OurInstructorController extends Controller
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
}
