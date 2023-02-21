<?php

namespace app\modules\admin;

use Yii;
use frontend\assets\AdminAsset;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
		AdminAsset::register(Yii::$app->view);
        parent::init();

        // custom initialization code goes here
    }
}
