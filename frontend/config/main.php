<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
//    'bootstrap'    => ['assetsAutoCompress'],
    'language'=>'uz',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@cabinet/messages',
//                    'sourceLanguage' => 'uz',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'main' => 'main.php',
                        'yii' => 'yii.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'enablePrettyUrl' => true,
            'ignoreLanguageUrlPatterns' => [
                // route pattern => url pattern
                '#^site/auth#' => '#^site/auth#',
                '#^api/*#' => '#^api/*#',
//                '#^favicon/*#' => '#^favicon/*#',
                '#^doc/import-excel#' => '#^doc/import-excel#',
                '#^doc/send#' => '#^doc/send#',
                '#^doc/accept-data#' => '#^doc/accept-data#',
                '#^address/import#' => '#^address/import#',
                '#^mailgun-notification/store#' => '#mailgun-notification/store#',
            ],
            'showScriptName' => false,
//            'enableLanguageDetection' => false,
//            'enableDefaultLanguageUrlCode' => false,
//            'ignoreLanguageUrlPatterns'=>[
//              'api/' => 'api/'
//            ],
            'languages' => ['uz', 'ru','oz'],
//
        ]
    ],
    'params' => $params,
];
