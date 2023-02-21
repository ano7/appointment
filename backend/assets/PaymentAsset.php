<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Payment backend application asset bundle.
 */
 
class PaymentAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		//'css/custom/payment.css',
    ];
    public $js = [
		'js/custom/payment.js',
    ];
}

