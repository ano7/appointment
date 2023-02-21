<?php

namespace app\modules\appointment;

use Yii;
use backend\assets\AppointmentAsset;
/**
 * appointment module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\appointment\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
		AppointmentAsset::register(Yii::$app->view);
        parent::init();

        // custom initialization code goes here
    }
}
