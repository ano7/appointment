<?php

namespace app\modules\customer;

use Yii;
use backend\assets\CustomerAsset;
/**
 * customer module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\customer\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
		CustomerAsset::register(Yii::$app->view);
        parent::init();

        // custom initialization code goes here
    }
}
