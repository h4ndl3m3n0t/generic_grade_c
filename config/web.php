<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Grade Compiler',
    'defaultRoute' => 'site/login',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 's85U9aET9_Rc72REuICrTNLhFli7t_Eq',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            //Change your configuration here for the mailer component
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',
                'username' => 'ebb52aedb60d84',
                'password' => '8a7c6d1e904faa',
                'port' => '2525',
                'encryption' => 'tls',
            ],
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
        'pdf' => [
            'class' => 'kartik\mpdf\Pdf',
            'mode' => kartik\mpdf\Pdf::MODE_BLANK,
            'mode' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
            'options' => [
                'defaultFontSize' => 50
            ],
            'methods' => [
                'SetFooter' => ['|Page {PAGENO}|'],
            ],
        ],
        'assetManager'=> [
            'appendTimestamp' => true,
            'linkAssets' => true
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'rules' => [
                //Site Controller Route
                'login' => 'site/login',
                'signup' => 'site/signup',
                'logout' => 'site/logout',
                'request-password' => 'site/request-password-reset',
                'resend-email' => 'site/resend-verification-email',
                'verify-email/<token:\w+>' => 'site/verify-email',
                'reset-password/<token:\w+>' => 'site/reset-password',

                //Dashboard Controller Route
                'dashboard' => 'dashboard/index',
                'settings' => 'dashboard/settings',
                'settings/delete-account' => 'dashboard/delete-account',

                //School Controller Route
                'schools' => 'school/index',
                'school-create' => 'school/create',
                'school-update/<id:\d+>' => 'school/update',
                'school-delete/<id:\d+>' => 'school/delete',

                //Semester Controller Route
                'school/<school_id:\d+>/semesters' => 'semester/index',
                'school/<school_id:\d+>/semester-create' => 'semester/create',
                'school/<school_id:\d+>/semester-update/<id:\d+>' => 'semester/update',
                'school/<school_id:\d+>/semester-delete/<id:\d+>' => 'semester/delete',

                //print semester
                'school/<school_id:\d+>/semesters-print' => 'semester/print',

                //Subject Controller Route
                'school/<school_id:\d+>/semesters/<sem_id:\d+>/subjects' => 'subject/index',
                'school/<school_id:\d+>/semesters/<sem_id:\d+>/subject-create' => 'subject/create',
                'school/<school_id:\d+>/semesters/<sem_id:\d+>/subject/<id:\d+>' => 'subject/view',
                'school/<school_id:\d+>/semesters/<sem_id:\d+>/subject-update/<id:\d+>' => 'subject/update',
                'school/<school_id:\d+>/semesters/<sem_id:\d+>/subject-delete/<id:\d+>' => 'subject/delete',

                //print subject
                'school/<school_id:\d+>/semesters/<sem_id:\d+>/subject-print/<id:\d+>' => 'subject/print',
                'school/<school_id:\d+>/semesters/<sem_id:\d+>/subjects-print' => 'subject/print'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
