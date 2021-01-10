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
                <div class="title">Счет-фактуры</div>
            </div>
            <div class="body">
                <ul class="list">
                    <li class="item">
                        <div class="label">Входящие</div>
<!--                            <a href="#!" class="badge green">+ 2000-->

                        </a>
                    </li>
                    <li class="item">
                        <div class="label">Отправленные</div>
<!--                        <a href="#!" class="value">8</a>-->
                    </li>
                    <li class="item">
                        <div class="label">Сохраненные</div>
<!--                        <a href="#!" class="value">8</a>-->
                    </li>
                </ul>
            </div>
            <div class="footer"><a href="/facturas/create" class="footer-link green">+ Создать новую фактуру</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <img src="/new_template/images/card/document-2.svg" alt="">
                <div class="title">Доверенность</div>
            </div>
            <div class="body">
                <ul class="list">
                    <li class="item">
                        <div class="label">Входящие</div>
<!--                            <a href="#!" class="badge yellow">+1 000-->

                        </a>
                    </li>
                    <li class="item">
                        <div class="label">Отправленные</div>
<!--                        <a href="#!" class="value">8</a>-->
                    </li>
                    <li class="item">
                        <div class="label">Сохраненные</div>
<!--                        <a href="#!" class="value">8</a>-->
                    </li>
                </ul>
            </div>
            <div class="footer"><a href="/empowerment/create" class="footer-link yellow">+ Создать доверенность</a>
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
                <div class="right"><a href="/reestr/create" class="btn-gray">+ Создать Реестр</a>
                </div>
            </div>
            <div class="body">
                <?= $this->render('index_reestr',['searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,])?>
            </div>
        </div>
    </div>
</div>
