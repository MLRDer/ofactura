<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$lang = Yii::$app->language;
$this->title = Yii::t('main','Информационная система по приёмке и отправке счёт-фактур');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76852852-6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-76852852-6');
    </script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/img/favicon.png" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="<?= Yii::t('main','SEO_META_DESCRIPTIONS')?>">
    <meta name="keywords" content="onlayn faktura, xisob faktura, elektron faktura, e faktura, soliq faktura, soliq rouming, factura uz, shot faktura">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
 <?= $content?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
