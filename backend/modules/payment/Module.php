<?php

namespace app\modules\payment;

use Yii;
use backend\assets\PaymentAsset;
/**
 * payment module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\payment\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
		PaymentAsset::register(Yii::$app->view);
        parent::init();

        // custom initialization code goes here
    }
}
