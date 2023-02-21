<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Customer backend application asset bundle.
 */
 
class CustomerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		//'css/custom/customer.css',
    ];
    public $js = [
		'js/custom/customer.js',
    ];
}

