<?php
return [
    'bootstrap' => ['gii'],
    'aliases' => [
        '@dektrium/user' => realpath(__DIR__ . '/../modules/user'),
    ],
    'modules' => [
        'gii' => 'yii\gii\Module',
        'user' => [
           'class' => 'dektrium\user\Module',
           'allowUnconfirmedLogin' => true,
           'confirmWithin' => 21600,
           'cost' => 12,
           'admins' => ['admin','tony'],
           'controllerMap' => [
                'admin' => 'backend\controllers\AdminController',
                'security' => 'backend\controllers\SecurityController'
            ],
           'components' => [
               'manager' => [
                   'userClass'    => 'backend\models\User',
                   'accountClass' => 'backend\models\Account',
                   'profileClass' => 'backend\models\Profile',
                   
               ]
               
           ]
       ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
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
        'showScriptName' => false,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                ],
            ],
        ],
    ],
];
