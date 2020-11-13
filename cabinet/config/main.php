<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'cabinet\controllers',
    'bootstrap' => ['log'],
//    'bootstrap'    => ['assetsAutoCompress'],
    'language'=>'uz',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
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
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-cabinet',
        ],     
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'enablePrettyUrl' => true,

            'ignoreLanguageUrlPatterns' => [
                // route pattern => url pattern
                '#^site/auth#' => '#^site/auth#',
                '#^api/*#' => '#^api/*#',
                '#^payme/*#' => '#^payme/*#',
                '#^themes/*#' => '#^themes/*#',
                '#^doc/import-excel#' => '#^doc/import-excel#',
//                '#^doc/switch-type#' => '#^doc/switch-type#',
                '#^doc/import-reestr#' => '#^doc/import-reestr#',
                '#^reestr/import-reestr#' => '#^reestr/import-reestr#',
                '#^doc/send#' => '#^doc/send#',
                '#^doc/accept-data#' => '#^doc/accept-data#',
                '#^doc/reject-data#' => '#^doc/reject-data#',
                '#^doc/canceled-data#' => '#^doc/canceled-data#',

                '#^empowerment/send#' => '#^empowerment/send#',
                '#^empowerment/accept-data#' => '#^empowerment/accept-data#',
                '#^empowerment/reject-data#' => '#^empowerment/reject-data#',
                '#^empowerment/canceled-data#' => '#^empowerment/canceled-data#',
                '#^empowerment/get-buyer-sign#' => '#^empowerment/get-buyer-sign#',

                '#^address/import#' => '#^address/import#',
                '#^mailgun-notification/store#' => '#mailgun-notification/store#',
            ],
            'showScriptName' => false,
            'enableLanguageDetection' => true,
            'enableDefaultLanguageUrlCode' => true,
            'languages' => ['uz', 'ru','oz'],
        ]

    ],
    'params' => $params,
];
