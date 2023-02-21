<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
 
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/custom/custom.css',
		'css/jquery-confirm.min.css',
		'css/bootstrap-select.min.css',
    ];
    public $js = [
	    'js/demo.js',
        'js/bootstrap-select.min.js',
		'js/jquery-confirm.min.js',
		'js/custom/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}

