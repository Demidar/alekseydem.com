<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$projects = require(__DIR__ . '/projects.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'modules' => [
        'portfolio' => [
            'class' => 'app\modules\portfolio\Module',
        ],
        'blog' => [
            'class' => 'app\modules\blog\Module',
        ],
        'checker' => [
            'class' => 'app\modules\checker\Module',
        ],
        'checkerdb' => [
            'class' => 'app\modules\checkerdb\Module',
        ],
    ],
    'aliases' => [
        '@pf' => '@app/modules/portfolio',
        '@blog' => '@app/modules/blog',
        '@checker' => '@app/modules/checker',
        '@checkerdb' => '@app/modules/checkerdb',
    ],
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'NhAC16xCvqcmwH0COhgjhOtcupM9HCPa',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://localhost:27017/test',
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'resume' => 'site/resume',
                'portfolio' => 'portfolio/default/index',
                'portfolio/projects' => 'portfolio/default/projects',
                'blog' => 'blog/default/index',
                'blog/article' => 'blog/article/article',
                'checker' => 'checker/default/index',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'authManagerMongoDB' => [
            'class' => 'yii\mongodb\rbac\MongoDbManager'
        ]
    ],
    
    // событие после каждого действия записывает последнюю посещенную страницу, кроме страницы дебага и авторизации
    'on afterAction' => function (yii\base\ActionEvent $e) {
        if ($e->action->controller->id !== 'site' && $e->action->id !== 'login') {
            if (!preg_match('*/debug/default*', Yii::$app->request->url)) {
                Yii::$app->user->setReturnUrl(Yii::$app->request->Url);
            }
        }
    },
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'panels' => [
            'mongodb' => [
                'class' => 'yii\\mongodb\\debug\\MongoDbPanel',
                 'db' => 'mongodb', // ID MongoDB компонента, по умолчанию `db`. Раскоментируйте и измените эту строку, если вы регистрируете компонент MongoDB с другим ID.
            ],
        ]
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '163.172.200.3'],
    ];
}

return $config;
