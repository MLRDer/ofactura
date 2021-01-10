<?php


?>
<?php
$host = Yii::$app->request->getPathInfo();
?>
<div class="sidebar">
    <div class="sidebar-top">
        <a href="/" class="logo">
            <img src="/new_template/images/logo/logo.png" alt="">
        </a>
        <ul class="sidebar-menu">
            <li class="menu__item <?= ($host=="site/index" || $host=="" )?'active':'' ?>">
                <a href="/" class="menu__link">
                            <span class="item">
                                <span class="icon home"></span>
                                <span class="title"><?= Yii::t('main','Главная')?></span>
                            </span>
                </a>
            </li>
            <li class="menu__item <?= ($host=="facturas/index" || $host=="facturas/update" || $host=="facturas/create" || $host=="facturas/view")?'active':'' ?>">
                <a href="/facturas/index" class="menu__link">
                            <span class="item">
                                <span class="icon invoices"></span>
                                <span class="title"><?= Yii::t('main','Счет-фактуры') ?> </span>
                            </span>
                    <?= \cabinet\models\Components::getNotifiy(\common\models\Notifications::TYPE_FACTURA)?>
                </a>
            </li>
            <li class="menu__item <?= ($host=="empowerment/index" || $host=="empowerment/update" || $host=="empowerment/create" || $host=="empowerment/view")?'active':'' ?>">
                <a href="/empowerment/index" class="menu__link">
                            <span class="item">
                                <span class="icon proxy"></span>
                                <span class="title"><?= Yii::t('main','Доверенность')?></span>
                            </span>
<!--                    <span class="badge yellow">+ 1000</span>-->
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