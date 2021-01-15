<?php

/* @var $this yii\web\View */

$this->title = Yii::t('main','Online factura xujjat almashish tizimi');
$session = Yii::$app->session->get('mode','min');
use common\widgets\Alert; ?>

<div class="row m-b-30">
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <img src="/new_template/images/card/document.svg" alt="">
                <div class="title"><?= Yii::t('main', "Счет-фактуры") ?></div>
            </div>
            <div class="body">
                <ul class="list">
                    <li class="item">
                        <div class="label"><?= Yii::t('main', 'Входящие');?></div>
<!--                            <a href="#!" class="badge green">+ 2000-->
                        </a>
                    </li>
                    <li class="item">
                        <div class="label"><?= Yii::t('main', 'Отправленные')?></div>
<!--                        <a href="#!" class="value">8</a>-->
                    </li>
                    <li class="item">
                        <div class="label"><?= Yii::t('main', 'Сохраненные')?></div>
<!--                        <a href="#!" class="value">8</a>-->
                    </li>
                </ul>
            </div>
            <div class="footer"><a href="/facturas/create" class="footer-link green">+ <?= Yii::t('main', 'Создать новую фактуру')?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <img src="/new_template/images/card/document-2.svg" alt="">
                <div class="title"><?= Yii::t('main', "Доверенность")?></div>
            </div>
            <div class="body">
                <ul class="list">
                    <li class="item">
                        <div class="label"><?= Yii::t('main', 'Входящие');?></div>
<!--                            <a href="#!" class="badge yellow">+1 000-->
                        </a>
                    </li>
                    <li class="item">
                        <div class="label"><?= Yii::t('main', 'Отправленные')?></div>
<!--                        <a href="#!" class="value">8</a>-->

                    </li>
                    <li class="item">
                        <div class="label"><?= Yii::t('main', 'Сохраненные')?></div>
<!--                        <a href="#!" class="value">8</a>-->
                    </li>
                </ul>
            </div>
            <div class="footer"><a href="/empowerment/create" class="footer-link yellow">+ <?= Yii::t('main', "Создать доверенность")?></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-card">
            <div class="header">
                <div class="left">
                    <img src="/new_template/images/icon/restr.svg" alt="">
                    <div class="title">Реестр</div>
                </div>
                <div class="right"><a href="/reestr/create" class="btn-gray"><?= Yii::t('main', '+ Создать Реестр') ?></a>
                </div>
            </div>
            <div class="body">
                <table>
                    <thead>
                    <tr>
                        <th>Номер реестра</th>
                        <th>Дата создания реестра</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#</td>
                        <td>##</td>
                    </tr>
<!--                    <tr>-->
<!--                        <td>№ 25-2555</td>-->
<!--                        <td>08.10.2020 / 09:58</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>№ 25-2555</td>-->
<!--                        <td>08.10.2020 / 09:58</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>№ 25-2555</td>-->
<!--                        <td>08.10.2020 / 09:58</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>№ 25-2555</td>-->
<!--                        <td>08.10.2020 / 09:58</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>№ 25-2555</td>-->
<!--                        <td>08.10.2020 / 09:58</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>№ 25-2555</td>-->
<!--                        <td>08.10.2020 / 09:58</td>-->
<!--                    </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
