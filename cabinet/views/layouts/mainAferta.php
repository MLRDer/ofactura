<?php

/* @var $this \yii\web\View */
/* @var $content string */

use cabinet\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);

$model = \common\models\Aferta::findOne(['id'=>1]);
$this->title = $model['title_'.Yii::$app->language];

$aferta_data = [
    "company_id"=>\cabinet\models\Components::GetId(),
    'user_id'=>Yii::$app->user->id,
    'aferta'=>$model['body_'.Yii::$app->language]
];
$aferta_data = \yii\helpers\Json::encode($aferta_data);
$aferta_data = base64_encode($aferta_data);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<style>
    body{
        color:black!important;
    }
</style>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>-->
    <script>
        // WebFont.load({
        //     google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        //     active: function() {
        //         sessionStorage.fonts = true;
        //     }
        // });
    </script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="/themes/vendors/general/jquery/dist/jquery.js",></script>
    <script src="/js/e-imzo.js"></script> 
    <script src="/js/e-imzo-client.js"></script>
    <script src="/js/pace.min.js"></script>
    <style>
        .pace {
            -webkit-pointer-events: none;
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .pace-inactive {
            display: none;
        }

        .pace .pace-progress {
            background: #2681e9;
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 100%;
            width: 100%;
            height: 2px;
        }

        .pace .pace-progress-inner {
            display: block;
            position: absolute;
            right: 0px;
            width: 100px;
            height: 100%;
            box-shadow: 0 0 10px #2681e9, 0 0 5px #2681e9;
            opacity: 1.0;
            -webkit-transform: rotate(3deg) translate(0px, -4px);
            -moz-transform: rotate(3deg) translate(0px, -4px);
            -ms-transform: rotate(3deg) translate(0px, -4px);
            -o-transform: rotate(3deg) translate(0px, -4px);
            transform: rotate(3deg) translate(0px, -4px);
        }

        .pace .pace-activity {
            display: block;
            position: fixed;
            z-index: 2000;
            top: 15px;
            right: 15px;
            width: 14px;
            height: 14px;
            border: solid 2px transparent;
            border-top-color: #2681e9;
            border-left-color: #2681e9;
            border-radius: 10px;
            -webkit-animation: pace-spinner 400ms linear infinite;
            -moz-animation: pace-spinner 400ms linear infinite;
            -ms-animation: pace-spinner 400ms linear infinite;
            -o-animation: pace-spinner 400ms linear infinite;
            animation: pace-spinner 400ms linear infinite;
        }

        @-webkit-keyframes pace-spinner {
            0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
        }
        @-moz-keyframes pace-spinner {
            0% { -moz-transform: rotate(0deg); transform: rotate(0deg); }
            100% { -moz-transform: rotate(360deg); transform: rotate(360deg); }
        }
        @-o-keyframes pace-spinner {
            0% { -o-transform: rotate(0deg); transform: rotate(0deg); }
            100% { -o-transform: rotate(360deg); transform: rotate(360deg); }
        }
        @-ms-keyframes pace-spinner {
            0% { -ms-transform: rotate(0deg); transform: rotate(0deg); }
            100% { -ms-transform: rotate(360deg); transform: rotate(360deg); }
        }
        @keyframes pace-spinner {
            0% { transform: rotate(0deg); transform: rotate(0deg); }
            100% { transform: rotate(360deg); transform: rotate(360deg); }
        }

    </style>
    <link rel="shortcut icon" href="/img/favicon.png" />
    <?php $this->head() ?>
</head>
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid   kt-aside--fixed kt-aside--minimize kt-page--loading">
<?php $this->beginBody() ?>

<!-- begin:: Page -->
<input type="hidden" id="langs" value="<?= Yii::$app->language?>">
<!-- begin:: Header Mobile -->


<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <!-- begin:: Aside -->

        <!-- end:: Aside -->

            <!-- begin:: Header -->

            <!-- end:: Header -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                <!-- begin:: Content -->
                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

                        <!--Begin::Dashboard 6-->

                        <!--Begin::Section-->


                                    <!--Begin::Dashboard 6-->

                                    <!--Begin::Section-->
                                    <div class="row">

                                        <div class="col-xl-12">

                                            <!--begin:: Widgets/Order Statistics-->
                                            <div class="kt-portlet kt-portlet--height-fluid">
                                                <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-label">
                                                        <h3 class="kt-portlet__head-title">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                                    <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" id="check" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" id="Combined-Shape" fill="#000000"/>
                                                                </g>
                                                            </svg>
                                                            <?= $this->title ?>
                                                        </h3>
                                                    </div>
                                                    <div class="kt-portlet__head-toolbar">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <img src="/img/<?= Yii::$app->language?>.png" width="25px">
                                                                    <?= Yii::$app->language ?>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                                    <a class="dropdown-item" href="/uz">
                                                                        <img src="/img/uz.png" width="20px"> UZB
                                                                    </a>
                                                                    <a class="dropdown-item" href="/oz"><img src="/img/uz.png" width="20px"> OZB</a>
                                                                    <a class="dropdown-item" href="/ru"><img src="/img/ru.png" width="20px"> RUS</a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body kt-portlet__body--fluid" style="height: calc(100vh - 150px);">

                                                    <div class="kt-widget12">
                                                        <div style="height: calc(100vh -  250px);overflow: auto;">
                                                            <?= $model['body_'.Yii::$app->language] ?>

                                                            <p style="display: none;" id="Aferta">
                                                                <?=  $aferta_data?>
                                                            </p>
                                                        </div>
                                                         <div style="padding-top:20px">
                                                            <button class="btn btn-brand" onclick="AcceptAferta()">
                                                                <i class="la la-check-circle"></i> <?= Yii::t('main','Tasdiqlash')?>
                                                            </button>
                                                            <a href="/site/logout" class="btn btn-danger">
                                                                <i class="la la-times"></i> <?= Yii::t('main','Rad etish')?>
                                                            </a>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end:: Widgets/Order Statistics-->
                                        </div>
                                    </div>




                    </div>
                </div>
                <!-- end:: Content -->
                <!-- end:: Content -->
            </div>
            <!-- begin:: Footer -->

            <!-- end:: Footer -->

    </div>
</div>

<!-- end:: Page -->


<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<!-- begin::Demo Panel -->
 

<!-- end::Demo Panel -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var getTimestamp = function (context_url, signature_hex, callback, fail) {
        $.ajax({
            url: '/api/gettimestamp',
            method: 'POST',
            data: {
                signatureHex: signature_hex
            },
            success: function (data) {
                if (data.Success) {
                    callback(data.Data);
                } else {
                    fail(data.Reason);
                }
            },
            error: function (response) {
                fail(response);
            }
        });
    }
    var timestamper = function (signature_hex, callback, fail) {
        getTimestamp("/faktura/ru", signature_hex, callback, fail);
    };
    var failDsvs = function (a, b) {
        alert("failDsys:"+ (a ? a : "") + (b ? b : ""));
    };
    function AcceptAferta(){

        var keyId = window.localStorage.getItem("auth_key");
        console.log(keyId);
        var facturaJson = $("#Aferta").text();

        EIMZOClient.createPkcs7(keyId, facturaJson, timestamper, function (pkcs7) {
            $.ajax({
                type: "POST",
                url: "/api/aferta",
                data: {
                    data: pkcs7
                },
                success: function (json) {
                    if (json.Success) {
                        location.href="/";
                    } else {
                        alertError(json.reason);
                    }
                },
                error: function (response) {
                    alertError(response);
                }
            });
        }, failDsvs);

    }
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#22b9ff",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(56983885, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/56983885" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
