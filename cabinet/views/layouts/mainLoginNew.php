<?php

/* @var $this \yii\web\View */
/* @var $content string */

use cabinet\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\cabinet\assets\NewAssetLogin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/img/favicon.png" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="/js/e-imzo.js"></script>
    <script src="/js/e-imzo-client.js"></script>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>
<input type="hidden" id="langs" value="<?= Yii::$app->language?>">
<!-- begin:: Page -->

<div class="site-wrapper">
    <div class="sign-in"><a href="#!" class="back-to-home"><span class="img-block"><img src="/new_template/images/icon/arrow-left.svg" alt=""> </span><span class="title">Вернуться назад</span></a>
        <?= $content ?>
        <ul class="lang-list">
            <li class="lang-item active">
                <a href="#!" class="lang-link">
                    <img src="/new_template/images/header/lang-ru.svg" alt="">
                </a>
            </li>
            <li class="lang-item">
                <a href="#!" class="lang-link">
                    <img src="/new_template/images/header/lang-uz.svg" alt="">
                </a>
            </li>
        </ul>
        <div class="phone-info">
            <div class="title">Call center:</div>
            <div class="phone">+ 998 (71)-200-11-22</div>
        </div>
    </div>

</div>



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
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
