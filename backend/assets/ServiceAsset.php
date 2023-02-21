<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Service backend application asset bundle.
 */
 
class ServiceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		//'css/custom/service.css',
    ];
    public $js = [
		'js/custom/service.js',
    ];
}

