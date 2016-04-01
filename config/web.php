<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
	'language' => 'ru-RU',
    'bootstrap' => ['log', 'fluent'],
	'modules' => [
  		'fluent' => [
  			'class' => 'yii\fluent\Module',
  		],
        'backend' =>[
            'class' => 'app\modules\backend\Module',
        ]
  	],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'egwweg'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'i18n' => [
            'translations' => [
                'app/*' => [
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages',
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app/main' => 'main.php',
                    ]
                ]
            ]
        ],
		
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
		'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'admin/<controller:()>/<action:[\w-]+>' => 'backend/<controller>/<action>',
                '<controller:\w+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => '<module>/<controller>/<action>'
            ],
         ],
		 
		 
		 /*'view' => [
            'theme' =>[
                'pathMap' => [
                    '@vendor/losyear/yii2-fluent/modules/admin/views/partials' => '@app/modules/backend/views/partials'
                ],
                'baseUrl' => '@web',
                'basePath' => '@app/theme'
            ]
        ]*/
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}
return array_merge_recursive($config, require(dirname(__FILE__) . '/../vendor/losyear/yii2-fluent/config/fluent.php'));
