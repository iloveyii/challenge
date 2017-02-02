<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => '\yii\db\Connection',
            'dsn' => 'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=challenge',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];