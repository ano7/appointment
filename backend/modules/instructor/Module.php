<?php

namespace app\modules\instructor;

use Yii;
use backend\assets\InstructorAsset;
/**
 * instructor module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\instructor\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
		InstructorAsset::register(Yii::$app->view);
        parent::init();

        // custom initialization code goes here
    }
}
