<?php

/* @var $this yii\web\View */


$this->registerMetaTag([
    'name' =>'business:contact_data:locality',
    'content'=>'Tashkent',
]);

$this->registerMetaTag([
    'name' =>'business:contact_data:country_name',
    'content'=>'Uzbekistan',
]);
$this->registerMetaTag([
    'name' =>'business:contact_data:website',
    'content'=>'https://onlinefactura.uz',
]);


$this->registerMetaTag([
    'itemprop' =>'name',
    'content'=>'Onlinefactura',
]);
$this->registerMetaTag([
    'itemprop' =>'description',
    'content'=>Yii::t('main','Информационная система по приёмке и отправке счёт-фактур'),
]);
$this->registerMetaTag([
    'itemprop' =>'description',
    'image'=>'https://onlinefactura.uz/img/favicon.png',
]);



$this->registerMetaTag([
    'name' =>'twitter:card',
    'content'=>'summary',
]);

$this->registerMetaTag([
    'name' =>'twitter:site',
    'content'=>'onlinefactura.uz',
]);

$this->registerMetaTag([
    'name' =>'twitter:title',
    'content'=>Yii::t('main','Информационная система по приёмке и отправке счёт-фактур'),
]);
$this->registerMetaTag([
    'name' =>'twitter:description',
    'content'=>Yii::t('main','SEO_ALL_DESCRIPTION'),
]);
$this->registerMetaTag([
    'name' =>'twitter:image:src',
    'content'=>'https://onlinefactura.uz/img/favicon.png',
]);
$this->registerMetaTag([
    'name' =>'twitter:domain',
    'content'=>'onlinefactura.uz',
]);



$this->registerMetaTag([
    'name' =>'description',
    'content'=>Yii::t('main','SEO_ALL_DESCRIPTION'),
]);

$this->registerMetaTag([
    'name' =>'keywords',
    'content'=>Yii::t('main','SEO_KEYWORDS'),
]);

$this->registerMetaTag([
    'property' =>'og:type',
    'content'=>'profile',
]);
$this->registerMetaTag([
    'property' =>'og:title',
    'charset'=>'UTF-8',
    'content'=>Yii::t('main','Информационная система по приёмке и отправке счёт-фактур'),
]);

$this->registerMetaTag([
    'property' =>'og:description',
    'charset'=>'UTF-8',
    'content'=>Yii::t('main','SEO_ALL_DESCRIPTION'),
]);
$this->registerMetaTag([
    'property' =>'og:image',
    'charset'=>'UTF-8',
    'content'=>'https://onlinefactura.uz/img/favicon.png',
]);

$this->registerMetaTag([
    'property' =>'og:url',
    'content'=>'https://onlinefactura.uz/',
]);
$this->registerMetaTag([
    'property' =>'og:site_name',
    'content'=>'onlinefactura.uz',
]);
$this->registerMetaTag([
    'property' =>'og:site_name',
    'content'=>'https://onlinefactura.uz',
]);


?>