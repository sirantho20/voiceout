<?php
return [
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
        'user' => [
           'class' => 'dektrium\user\Module',
           'allowUnconfirmedLogin' => true,
           'confirmWithin' => 21600,
           'cost' => 12,
           'admins' => ['admin'],
           'controllerMap' => [
                'admin' => 'backend\controllers\AdminController'
            ],
           'components' => [
               'userClass'    => 'backend\models\User'
           ]
       ],
    ],
    
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'urlManager' => [
        'class' => 'yii\web\UrlManager',
        'enablePrettyUrl' => true,
        'showScriptName' => true
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
    ],
];
