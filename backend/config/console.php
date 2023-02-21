<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
	'name'=>'DHE-ERP',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\commands',
    'bootstrap' => ['log'],
    'modules' => [
		'admin' => [
			'class' => 'mdm\admin\Module',
			'layout' => 'left-menu', // it can be '@path/to/your/layout'.
			'controllerMap' => [
				'assignment' => [
					'class' => 'mdm\admin\controllers\AssignmentController',
					'userClassName' => 'common\models\User',
					'idField' => 'user_id'
				],
				'other' => [
					'class' => 'path\to\OtherController', // add another controller
				],
			],
			'menus' => [
				'assignment' => [
					'label' => 'Grand Access' // change label
				],
				//'route' => null, // disable menu route
			]
		],
	    'master' => [
            'class' => 'app\modules\master\Master',
        ],
        'college' => [
            'class' => 'app\modules\college\Module',
        ],
        'course' => [
            'class' => 'app\modules\course\Module',
        ],
       'subject' => [
            'class' => 'app\modules\subject\Module',
        ],
        'fee' => [
            'class' => 'app\modules\fee\Module',
        ],
	],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            //'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],
		'view' => [
			 'theme' => [
				 'pathMap' => [
					//'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
					'@app/views'   => 'layout/main'
				 ],
			 ],
		],
		'assetManager' => [
			'bundles' => [
			 
				'@vendor\dmstr\yii2-adminlte-asset\web\AdminLteAsset' => [
					'skin' => 'skin-black',
				],
			],
		],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
		'utility' => [
            'class' => 'app\components\Utility', 
        ],
		'college' => [
            'class' => 'app\components\College', 
        ],
		'course' => [
            'class' => 'app\components\Course', 
        ],
		'subject' => [
            'class' => 'app\components\Subject', 
        ],
		'fee' => [
            'class' => 'app\components\Fee', 
        ],
    ],
	'as access' => [
		'class' => 'mdm\admin\components\AccessControl',
		'allowActions' => [
			'site/login',
			'site/error',
		]
	],
    'params' => $params,
];
if (YII_ENV_DEV) {    
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // HERE
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'adminlte' => '@vendor/dmstr/yii2-adminlte-asset/gii/templates/crud/simple',
                ]
            ]
        ],
    ];
}