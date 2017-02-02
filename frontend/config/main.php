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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'challenge/index',
                'subcategory' => 'site/services',
                'contact' => 'site/contact',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/softhem/smarty/views'
                ],
            ],
        ],
        'assetManager'=>[
            'class'=>'yii\web\AssetManager',
            'forceCopy' => false,
            'bundles'=>[
                'softhem\assets\GreenishAsset'=>[
                    'depends'=>[
                        'yii\web\YiiAsset',
                    ]
                ],
                'softhem\assets\SmartyAsset'=>[
                    'depends'=>[
                        'yii\web\YiiAsset',
                    ]
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '306955959641097',
                    'clientSecret' => '384f905a16717fd6ddd74406a6f568ca',
                ],
                'google'=>[
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '983038409175-40fvmv6ks2m9u1gmbqu2fud2pggi252k.apps.googleusercontent.com',
                    'clientSecret' => 'puEWActtHO1raFmSqRCbccYF',
                ],
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'forum' => [
            'class' => 'frontend\modules\forum\Module'
        ]
    ]
];



