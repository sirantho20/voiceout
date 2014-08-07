<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
                'user' => [
           'class' => 'dektrium\user\Module',
           'allowUnconfirmedLogin' => true,
           'confirmWithin' => 21600,
           'cost' => 12,
           'admins' => ['admin','tony','badjornor'],
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
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                    //'<controller:\w+>/<id:\d+>' => '<controller>/view',
                    'complaint/new' => 'complaint/new',
                    'complaint/tag' => 'complaint/tag',
                    'complaint/all' => 'complaint/all',
                    'complaint/reply' => 'complaint/reply',
                    'complaint/escalate' => 'complaint/escalate',
                    'complaint/follow' => 'complaint/follow',
                    'complaint/unfollow' => 'complaint/unfollow',
                    'complaint/<slug:[a-zA-Z0-9-]+>' => 'complaint/index',
                    'company/new' => 'company/new',
                    'company/all' => 'company/all',
                    'company/follow' => 'company/follow',
                    'company/unfollow' => 'company/unfollow',
                    'company/followers' => 'company/followers',
                    'company/getcompany' => 'company/getcompany',
                    'company/<slug:[a-zA-Z0-9-]+>' => 'company/index',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ]
         ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'Thisr@th3rLong&wINdIngSt!ng',
        ],
    ],
    'params' => $params,
];