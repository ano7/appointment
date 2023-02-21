<?php

namespace app\modules\services;

use Yii;
use backend\assets\ServiceAsset;
/**
 * services module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\services\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
		ServiceAsset::register(Yii::$app->view);
        parent::init();

        // custom initialization code goes here
    }
}
