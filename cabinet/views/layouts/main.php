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

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<input type="hidden" id="langs" value="<?= Yii::$app->language?>">
<div class="site-wrapper">
    <div class="main-wrapper">

        <?= \cabinet\widgets\SidebarNew::widget()?>

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
                        <li class="notification-item active"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="notification-modal-2">
                    <ul class="notification-list">
                        <li class="notification-item active"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="notification-modal-3">
                    <ul class="notification-list">
                        <li class="notification-item active"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
                        </li>
                        <li class="notification-item"><span class="badge gray">12.10.2020 </span><a href="#!" class="notification-link"><span class="title">Информационная система </span><span class="subtitle">Информационная система по приёмке и отправке счёт-фактур «onlinefactura.uz» (версия 1.0)</span></a>
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
