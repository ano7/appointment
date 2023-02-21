<?php

namespace frontend\assets;

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
		'calender/calendar.css',
		'calender/calendar_compact.css',
		'calender/calendar_full.css'
    ];
    public $js = [
	    'calender/calendar.js',
		'js/custom/service.js',
    ];
}

