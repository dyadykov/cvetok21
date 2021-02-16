<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv('DB_DSN'),
            'username' => 'root',
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
        ],
        'sourceDb' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv('SOURCE_DB_DSN'),
            'username' => 'root',
            'password' => getenv('SOURCE_DB_PASSWORD'),
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
