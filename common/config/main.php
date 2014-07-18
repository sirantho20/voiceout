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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        'showScriptName' => false
=======
=======
>>>>>>> 69e84d5e6f1210d42c81e28bae2ee694dd85add9
        'showScriptName' => true,
=======
        'showScriptName' => false,
>>>>>>> bencopy
        ],
    /*    'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                ],
            ],
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> master
=======
=======
        'showScriptName' => false
>>>>>>> bencopy
>>>>>>> 69e84d5e6f1210d42c81e28bae2ee694dd85add9
        ],
=======
        ], */
>>>>>>> bencopy
    ],
];
