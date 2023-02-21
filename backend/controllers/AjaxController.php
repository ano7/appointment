<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DistrictController implements the CRUD actions for ErpMasterDistrict model.
 */
class AjaxController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array(
            'verbs' => array(
                'class' => VerbFilter::className(),
                'actions' => array(
                    'delete' => array('POST'),
                ),
            ),
        );
    }
    /**
     * Lists all States models.
     * @return mixed
     */
    public function actionDistricts()
    {
		$State_ID    = Yii::$app->request->post('State_ID');
        $District_ID = Yii::$app->utility->getDistrict($State_ID);
		return json_encode($District_ID);
    }
}
