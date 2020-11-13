<?php

/* @var $this \yii\web\View */
/* @var $content string */

use cabinet\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\cabinet\assets\LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/img/favicon.png" />
<!--    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>-->
<!--    <script>-->
<!--        WebFont.load({-->
<!--            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},-->
<!--            active: function() {-->
<!--                sessionStorage.fonts = true;-->
<!--            }-->
<!--        });-->
<!--    </script>-->
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="/js/e-imzo.js"></script>
    <script src="/js/e-imzo-client.js"></script>

    <?php $this->head() ?>
    <style>
        .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container {
            width: 475px;
            margin: 0 auto;
            background: ;
            background-color:
                    white;
            box-shadow: 0 15px 20px
            rgba(0,0,0,0.05);
            padding: 50px 50px;
        }
        .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-login__logo {
            text-align: center;
            margin: 0 auto 1rem auto;
        }
        .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-login__head {
            margin-top: 1rem;
            margin-bottom: 0rem;
        }
        .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-login__head .kt-login__title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 500;
            color:black;
            padding-bottom:10px;

        }
        .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-form .form-control {
            eight: 48px;
            border: none;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            margin-top: 0rem;
            background:
                    #f8f9fa;
            border: 1px solid
            #00aeff;
            border-radius: 9px;
            font-size: 16px;
            color:#485057;
        }
        .btn-brand {
            color:
                    #fff;
            background-color:
                    #00aeff;
            border-color:
                    #00aeff;
        }
        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
            color:black;
            font-weight: 500;
            width: 100%;
            padding-bottom: 3px;
        }
        .btn.btn-light.btn-elevate {
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid
            #d4dde2;
        }
        }
        .input-group > .form-control, .input-group > .form-control-plaintext, .input-group > .custom-select, .input-group > .custom-file {

            width: auto;

                 }
        .btn-login{
            height: 48px;
            border-radius: 9px;
            font-size: 16px;
            font-weight: 300;
        }
        .btn-brand:not(:disabled):not(.disabled):active, .btn-brand:not(:disabled):not(.disabled).active, .show > .btn-brand.dropdown-toggle {

        }
        .btn-brand:hover {
            color:#fff;
            background-color:#21dff2!important;
            border-color: #21dff2 !important;
        }
    </style>
</head>
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<?php $this->beginBody() ?>
<input type="hidden" id="langs" value="<?= Yii::$app->language?>">
<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <?= $content ?>
    </div>
</div>

<!-- end:: Page -->

<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
    <div class="kt-footer__copyright">
        <span  class="kt-link"><?= Yii::t('main','Информационная система по приёмке и отправке счёт-фактур <B>«onlinefactura.uz»</B> (версия 1.0)')?> &nbsp;</span>

    </div>
    <div class="kt-footer__menu">
        <span>Call center (99871)-200-11-22</span>
<!--        <a href="http://onlinefactura.uz/about" target="_blank" class="kt-footer__menu-link kt-link">-->
<!--            --><?//= Yii::t('main','Bu qanday ishlatiladi')?>
<!--        </a>-->
<!--        <a href="http://onlinefactura.uz/contact" target="_blank" class="kt-footer__menu-link kt-link">-->
<!--            --><?//= Yii::t('main','Kontakt')?>
<!--        </a>-->
    </div>
</div>


<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
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
