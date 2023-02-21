<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/jquery-confirm.min.css',
		'vendor/animate.css/animate.min.css',
		'vendor/aos/aos.css',
		'vendor/bootstrap-icons/bootstrap-icons.css',
		'vendor/boxicons/css/boxicons.min.css',
		'vendor/remixicon/remixicon.css',
		'vendor/swiper/swiper-bundle.min.css',
		'css/style.css',
    ];
    public $js = [
	    'js/jquery-confirm.min.js',
	    'vendor/purecounter/purecounter.js',
	    'vendor/aos/aos.js',
	    'vendor/swiper/swiper-bundle.min.js',
	    'vendor/php-email-form/validate.js',
	    'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
