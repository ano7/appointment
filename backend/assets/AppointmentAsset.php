<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Appointmen backend application asset bundle.
 */
 
class AppointmentAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'css/custom/appointment.css',
		'calender/calendar.css',
		'calender/calendar_compact.css',
		'calender/calendar_full.css'
    ];
    public $js = [
	    'calender/calendar.js',
		'js/custom/appointment.js',
    ];
}

