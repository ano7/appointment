<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Instructor backend application asset bundle.
 */
 
class InstructorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		//'css/custom/instructor.css',
    ];
    public $js = [
		'js/custom/instructor.js',
    ];
}

