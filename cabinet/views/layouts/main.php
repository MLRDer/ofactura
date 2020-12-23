<?php

/* @var $this \yii\web\View */
/* @var $content string */

use cabinet\assets\AppAsset;
use cabinet\models\Components;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\cabinet\assets\NewAsset::register($this);
$this->title = $this->title." | ".Components::CompanyData('tin');
?>
<?php $this->beginPage() ?>

<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="/themes/vendors/general/jquery/dist/jquery.js",></script>
    <script src="/js/e-imzo.js"></script>
    <script src="/js/e-imzo-client.js"></script>
    <link rel="shortcut icon" href="/img/favicon.png" />
    <style>


        .nav-tabs .nav-item {
            margin-bottom: 0px!important;
        }

        .nav-tabs .nav-item .nav-link{
            border: unset;
        }
        .profile-tab-header .nav-item .nav-link.active, .profile-tab-header .nav-item .nav-link:hover {
            border: unset;
        }
        .input-white input.form-control{
            height:unset!important;
            border-radius: unset;
            border: unset;
        }
        .input input.form-control{
            height:unset!important;
            /*border-radius: unset;*/
            /*border: unset;*/
        }
        .singid-side-block{
            webkit-transform: translateY(10px);
            -moz-transform: translateY(10px);
            -ms-transform: translateY(10px);
            -o-transform: translateY(10px);
            transform: translateY(10px);
            opacity: 0;
            visibility: hidden;
            height: 0;
            overflow: hidden;
            -webkit-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }
        .singid-side-block.show-block {
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
            height: auto;
        }
        .input select {
            width: 100%;
            padding: 5px 20px;
            border: 1px solid #9794a9;
            -webkit-border-radius: 14px;
            -moz-border-radius: 14px;
            border-radius: 15px;
            background-color: transparent;
        }
        .help-block-error{
            background-color: #eabebe4d;
            color: red;
            font-weight: bold;
            border-radius: 5px;
            padding: 3px 15px;
            margin-top: 10px;
            margin-bottom: 0px;
        }
        .help-block-error:empty{
            background-color: unset;
            padding: unset;
        }
        .input-white input.form-control:focus{
            background-color: unset;
        }
        .blue-btn{
            background-color: #0075ff;
            color: white;
            padding: 8px 15px;
            border-radius: 10px;
            white-space: nowrap;
            display: block;
            height: 40px;
            width: 140px;
            webkit-box-shadow: 0 0 10px rgba(0,117,255,.4);
            -moz-box-shadow: 0 0 10px rgba(0,117,255,.4);
            box-shadow: 0 0 10px rgba(0,117,255,.4);
        }

        .second-input .form-group {
            margin-bottom: 0rem!important;
        }
        .icon-pdf{
            background-image: url("/new_template/ico/pdf-file-format-symbol.png");
            position: absolute;
            content: "";
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            width: 16px;
            height: 16px;
            margin: auto;
            -webkit-background-size: contain;
            -moz-background-size: contain;
            -o-background-size: contain;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: 50%;
        }

        .pagination li a{
            border: 0;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -moz-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -moz-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }
        .pagination li a:hover{
            z-index: 2;
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        .pagination li.active a{
            background-color: #0075ff;
        }
        .pagination .prev{
            margin-right: 10px!important
        }
        .pagination .next{
            margin-left: 10px!important;
        }
        .pagination li.active a{
            z-index: 3;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .pagination .disabled{
            display: none;
        }
        .pagination{
            margin-top: 33px;

        }
         .pagination img {
            display: block;
            width: unset;
        }

        table tbody tr td{

            color: #404040!important;

        }

</style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<input type="hidden" id="langs" value="<?= Yii::$app->language?>">
<div class="site-wrapper">
    <div class="main-wrapper">
        <div class="sidebar">
            <div class="sidebar-top">
                <a href="#!" class="logo">
                    <img src="/new_template/images/logo/logo.png" alt="">
                </a>
                <ul class="sidebar-menu">
                    <li class="menu__item active">
                        <a href="/" class="menu__link">
                            <span class="item">
                                <span class="icon home"></span>
                                <span class="title"><?= Yii::t('main','Главная')?></span>
                            </span>
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="/facturas/index" class="menu__link">
                            <span class="item">
                                <span class="icon invoices"></span>
                                <span class="title"><?= Yii::t('main','Счет-фактуры')?> </span>
                            </span>
                            <span class="badge green">+ 2000</span>
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="/letter-of-attorney.html" class="menu__link">
                            <span class="item">
                                <span class="icon proxy"></span>
                                <span class="title"><?= Yii::t('main','Доверенность')?></span>
                            </span>
                            <span class="badge yellow">+ 1000</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-footer">
                <div class="phone-info">
                    <div class="title">Call center:</div>
                    <div class="phone">+ 998 (71)-200-11-22</div>
                </div>
                <div class="info">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</div>
            </div>
        </div>

        <div class="content-wrapper">
            <?= \cabinet\widgets\HeadersNew::widget()?>
            <?= $content ?>
        </div>

    </div>
    <div class="notification-modal">
        <div class="content">
            <div class="close">
                <img src="/new_template/images/icon/close.svg" alt="">
            </div>
            <ul class="nav notification-tabs-header">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#notification-modal-1" aria-selected="true">Оповещения</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#notification-modal-2" aria-selected="false">Фактура</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#notification-modal-3" aria-selected="false">Доверенность</a>
                </li>
            </ul>
            <div class="tab-content notification-tabs-content">
                <div class="tab-pane fade show active" id="notification-modal-1">
                    <ul class="notification-list">
                        <li class="notification-item active"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="notification-modal-2">
                    <ul class="notification-list">
                        <li class="notification-item active"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="notification-modal-3">
                    <ul class="notification-list">
                        <li class="notification-item active"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 2.0)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= Yii::t('main','Продукции')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="ExtraAlcoModalArea">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('main','Close')?></button>
                <button type="button" class="btn btn-success" onclick="SetAlcoholName()"> <?= Yii::t('main','Accept')?></button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php $this->endPage() ?>
