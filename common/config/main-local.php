<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
<<<<<<< HEAD
            'dsn' => 'mysql:host=localhost;dbname=voiceout1',
=======
            'dsn' => 'mysql:host=127.0.0.1;dbname=voiceout',
>>>>>>> bencopy
            'username' => 'voiceout',
            'password' => 'voiceout',
            'charset' => 'utf8',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
    ],
];
