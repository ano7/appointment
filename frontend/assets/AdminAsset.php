<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Admin backend application asset bundle.
 */
 
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'css/custom/admin.css',
		'calender/calendar.css',
		'calender/calendar_compact.css',
		'calender/calendar_full.css'
    ];
    public $js = [
	    'calender/calendar.js',
		'js/custom/admin.js',
    ];
}
