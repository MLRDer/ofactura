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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76852852-5">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-76852852-5');
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
<!--==========================
 Header
 ============================-->
<header id="header">

    <div id="topbar">
        <div class="container">
            <div class="social-links">
                <?php if(Yii::$app->language=="uz"){ ?>
                    <a href="https://rouming.uz/uz/operators" class="twitter" target="_blank">
                        ЭҲФ операторини эркин танлашингиз мумкин
                    </a>
                <?php }?>
                <?php if(Yii::$app->language=="oz"){ ?>
                    <a href="https://rouming.uz/uz/operators" class="twitter" target="_blank">
                        ЭҲФ операторини эркин танлашингиз мумкин
                    </a>
                <?php }?>
                <?php if(Yii::$app->language=="ru"){ ?>
                    <a href="https://rouming.uz/ru/operators" class="twitter" target="_blank">
                        Можете свободно  выбрать оператора ЭСФ
                    </a>
                <?php }?>

            </div>
        </div>
    </div>

    <div class="container">

        <div class="logo float-left">
            <!-- Uncomment below if you prefer to use an image logo -->
            <div class="text-light">
                <a href="#intro" class="scrollto">
                    <img src="/img/favicon.png">    <span class="brand-name">FACTURA</span>
                </a>
            </div>

            <!-- <a href="#header" class="scrollto"><img src="/img/logo.png" alt="" class="img-fluid"></a> -->
        </div>

        <nav class="main-nav float-right d-none d-lg-block">
            <ul>
                <?php $menyu = \common\models\WebMenyu::find()->andWhere(['enabled'=>1])->orderBy('sort_order ASC')->all();
                foreach ($menyu as $items){
                ?>

                    <li><a href="<?= $items['path']?>"><?= $items['name_'.$lang] ?></a></li>
                <?php }?>

<?php
$langName = [
  'uz'=>'Узб',
  'oz'=>'Ozb',
  'ru'=>'Рус',
];
?>
                <li class="drop-down"><a href="#"><img width="20px" src="/img/<?= $lang?>.png"> <?= $langName[$lang] ?></a>
                    <ul>
                        <li><a href="/uz"><img src="/img/uz.png" width="20px"> <?= $langName['uz']?></a></li>
                        <li><a href="/oz"><img src="/img/uz.png" width="20px"> <?= $langName['oz']?></a></li>
                        <li><a href="/ru"><img src="/img/ru.png" width="20px"> <?= $langName['ru']?></a></li>

                    </ul>
                </li>
            </ul>
        </nav><!-- .main-nav -->

    </div>
</header><!-- #header -->

<!--==========================
  Intro Section
============================-->
<section id="intro" class="clearfix">
    <div class="container d-flex h-100">
        <div class="row justify-content-center align-self-center">
            <div class="col-md-6 intro-info order-md-first order-last">
                <h2>
                    <br>Online<span> Factura!</span>

                </h2>
                <h1 style="font-size: 20px;
font-weight: bold;
color: black;"><?= Yii::t('main','Информационная система по приёмке и отправке счёт-фактур')?></h1>

                <div>
                    <a href="https://cabinet.onlinefactura.uz" class="btn-get-started scrollto"><?= Yii::t('main','Tizimdan foydalanish')?></a>
                </div>

            </div>

            <div class="col-md-6 intro-img order-md-last order-first">
                <img src="/img/intro-img.svg" alt="" class="img-fluid">
            </div>
        </div>

    </div>
</section><!-- #intro -->

<main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">

        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-6">
                    <div class="about-img">
                        <img src="/img/a_h_rocket.png" alt="">
                    </div>
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="about-content">
                        <h2><?= Yii::t('main','About Us')?></h2>
                        <h3><?= Yii::t('main','Odio sed id eos et laboriosam consequatur eos earum soluta.')?></h3>
                        <p><?= Yii::t('main','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')?></p>
                        <p><?= Yii::t('main','Aut dolor id. Sint aliquam consequatur ex ex labore. Et quis qui dolor nulla dolores neque. Aspernatur consectetur omnis numquam quaerat. Sed fugiat nisi. Officiis veniam molestiae. Et vel ut quidem alias veritatis repudiandae ut fugit. Est ut eligendi aspernatur nulla voluptates veniam iusto vel quisquam. Fugit ut maxime incidunt accusantium totam repellendus eum error. Et repudiandae eum iste qui et ut ab alias.')?></p>
                        <ul>
                            <li><i class="ion-android-checkmark-circle"></i> <?= Yii::t('main','Ullamco laboris nisi ut aliquip ex ea commodo consequat.')?></li>
                            <li><i class="ion-android-checkmark-circle"></i> <?= Yii::t('main','Duis aute irure dolor in reprehenderit in voluptate velit.')?></li>
                            <li><i class="ion-android-checkmark-circle"></i> <?= Yii::t('main','Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.')?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- #about -->


    <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
        <div class="container">

            <header class="section-header">
                <h3><?= Yii::t('main','Services')?></h3>
                <p><?= Yii::t('main','Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.')?></p>
            </header>

            <div class="row">


                <?php $services = \common\models\WebServices::find()->andWhere(['enabled'=>1])->orderBy("sort_order ASC")->all();
                foreach ($services as $items){
                ?>

                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
                    <div class="box">
                        <?= $items['icon']?>
                        <h4 class="title"><a href=""><?= $items['name_'.$lang]?></a></h4>
                        <p class="description"><?= $items['anons_'.$lang]?></p>
                    </div>
                </div>

                <?php } ?>

            </div>

        </div>
    </section><!-- #services -->

    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
        <div class="container-fluid">

            <header class="section-header">
                <h3><?= Yii::t('main','Why choose us?')?></h3>
                <p><?= Yii::t('main','Why choose us title')?></p>
            </header>

            <div class="row">

                <div class="col-lg-6">
                    <div class="why-us-img" style="text-align: center">
                        <img src="/img/47b6910d8430ca5877422b092234c382.jpg" alt="" class="img-fluid" width="60%">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="why-us-content">

                        <div class="features wow bounceInUp clearfix">
                            <i class="fa fa-diamond" style="color: #f058dc;"></i>
                            <h4><?= Yii::t('main','Corporis dolorem')?></h4>
                            <p><?= Yii::t('main','Commodi quia voluptatum. Est cupiditate voluptas quaerat officiis ex alias dignissimos et ipsum. Soluta at enim modi ut incidunt dolor et.')?></p>
                        </div>

                        <div class="features wow bounceInUp clearfix">
                            <i class="fa  fa-shield" style="color: #ffb774;"></i>
                            <h4><?= Yii::t('main','Eum ut aspernatur')?></h4>
                            <p><?= Yii::t('main','Molestias eius rerum iusto voluptas et ab cupiditate aut enim. Assumenda animi occaecati. Quo dolore fuga quasi autem aliquid ipsum odit. Perferendis doloremque iure nulla aut.')?></p>
                        </div>

                        <div class="features wow bounceInUp clearfix">
                            <i class="ion-social-buffer" style="color: #589af1;"></i>
                            <h4><?= Yii::t('main','Voluptates dolores')?></h4>
                            <p><?= Yii::t('main','Voluptates nihil et quis omnis et eaque omnis sint aut. Ducimus dolorum aspernatur. Totam dolores ut enim ullam voluptas distinctio aut.')?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row counters">

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= Yii::t('main','274')?></span>
                    <p><?= Yii::t('main','Clients')?></p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= Yii::t('main','421')?></span>
                    <p><?= Yii::t('main','Projects')?></p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= Yii::t('main','1,364')?></span>
                    <p><?= Yii::t('main','Hours Of Support')?></p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= Yii::t('main','18')?></span>
                    <p><?= Yii::t('main','Hard Workers')?></p>
                </div>

            </div>

        </div>
    </section>

    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 text-center text-lg-left">
                    <h3 class="cta-title"><?= Yii::t('main','Call To Action')?></h3>
                    <p class="cta-text"> <?= Yii::t('main','Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')?></p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">
                    <a class="cta-btn align-middle" href="https://cabinet.onlinefactura.uz/" target="_blank"><?= Yii::t('main','Call To Action btn')?></a>
                </div>
            </div>

        </div>
    </section><!-- #call-to-action -->

    <!--==========================
      Features Section
    ============================-->
    <section id="features">
        <div class="container">

            <div class="row feature-item">
                <div class="col-lg-6 wow fadeInUp">
                    <img src="/img/features-1.svg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
                    <h4><?= Yii::t('main','Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.')?></h4>
                        <div>
                            <h3>
                                <a href="https://www.facebook.com/onlinefactura/" target="_blank">
                                    <img src="/img/facebook.png" width="45px"> Facebook
                                </a>
                            </h3>
                            <h3>
                                <a href="https://t.me/onlinefactura" target="_blank">
                                    <img src="/img/Telegram-512.png" width="45px"> Telegram
                                </a>
                            </h3>
                            <h3>
                                <a href="https://twitter.com/Onlinefacturauz" target="_blank">
                                    <img src="/img/twiter.png" width="43px"> Twitter
                                </a>
                            </h3>
                            <h3>
                                <a href="https://www.instagram.com/onlinefacturauz/" target="_blank">
                                    <img src="/img/174855.png" width="43px"> Instagram
                                </a>
                            </h3>
                        </div>

                </div>
            </div>

        </div>
    </section><!-- #about -->

    <section id="pricing" class="wow fadeInUp section-bg">

        <div class="container">

            <header class="section-header">
                <h3><?= Yii::t('main','Tarifikatsiya')?></h3>
                <p><?= Yii::t('main','Tizimdan foydalanishda amalga oshiriladigan sarf xarajatlar tarifikatsiyasi')?></p>
            </header>

            <div class="row flex-items-xs-middle flex-items-xs-center">

                <!-- Basic Plan  -->
                <div class="col-xs-12 col-lg-4"></div>
                <div class="col-xs-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3><?= Yii::t('main','700')?> <span class="period"> <?= Yii::t('main','so`m/1 ta xujjat')?></span></h3>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title">
                                <?= Yii::t('main','Odatiy tarifi')?>
                            </h4>
                            <ul class="list-group">
                                <li class="list-group-item"><?= Yii::t('main','Kiruvchi xujjatlar bepul')?></li>
                                <li class="list-group-item"><?= Yii::t('main',"Abonent to'lovi 4000 so`m/oyiga")?></li>
<!--                                <li class="list-group-item">Et perspiciatis suscipit</li>-->
                                <li class="list-group-item"><?= Yii::t('main','24/7 Call markaz xizmati')?></li>
                            </ul>
                            <a href="https://cabinet.onlinefactura.uz" class="btn"><?= Yii::t('main','Foydalanish btn')?></a>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-lg-4"></div>

            </div>
        </div>

    </section><!-- #pricing -->

    <!--==========================
      Frequently Asked Questions Section
    ============================-->
    <section id="faq">
        <div class="container">
            <header class="section-header">
                <h3><?= Yii::t('main','Ko`p beriladigan savollar')?></h3>
                <p><?= Yii::t('main','Tizimda yuzaga keladigan turli tushimovchiliklarda yuzaga keladigan savollarga javoblar toplami')?></p>
            </header>

            <ul id="faq-list" class="wow fadeInUp">
                <?php $feed = \common\models\WebFeedBack::find()->orderBy('sort_order ASC')->all();
                foreach ($feed as $items){
                ?>
                <li>
                    <a data-toggle="collapse" class="collapsed" href="#faq<?= $items->id ?>"><?= $items['name_'.$lang]?><i class="ion-android-remove"></i></a>
                    <div id="faq<?= $items->id ?>" class="collapse" data-parent="#faq-list">
                        <p style="font-size:14px">
                             <?= $items['body_'.$lang]?>
                        </p>
                    </div>
                </li>
                <?php }?>

            </ul>

        </div>
    </section><!-- #faq -->

</main>

<!--==========================
  Footer
============================-->
<footer id="footer" class="section-bg">
    <div class="footer-top">
        <div class="container">

            <div class="row">

                <div class="col-lg-6">

                    <div class="row">

                        <div class="col-sm-6">

                            <div class="footer-info">
                                <h3><?= Yii::t('main','ONLINE FACTURA')?></h3>
                                <p><?= Yii::t('main','Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.')?></p>
                            </div>

                            <div class="footer-newsletter">
                                <h4><?= Yii::t('main','Our Newsletter')?></h4>
                                <p></p>
                                <?= Yii::t('main','Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem.')?>
<!--                                <form action="" method="post">-->
<!--                                    <input type="email" name="email"><input type="submit"  value="Subscribe">-->
<!--                                </form>-->
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="footer-links">
                                <h4><?= Yii::t('main','Useful Links')?></h4>
                                <ul>
                                    <li>
                                        <a href="https://soliq.uz/" target="_blank">
                                            <img src="/img/gerb.png" width="25px"> SOLIQ.UZ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://my.soliq.uz/" target="_blank">
                                            <img src="/img/logo-gnk.png" width="25px">    MY.SOLIQ.UZ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://rouming.uz/" target="_blank">
                                            <img src="/img/rouming.png" width="25px"> ROUMING.UZ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://esi.uz/" target="_blank">
                                            <img src="/img/esi.png" width="20px"> ESI.UZ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://e-imzo.uz/" target="_blank">
                                            <img src="/img/logo (2).png" height="25px">
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="footer-links">
                                <h4><?= Yii::t('main','Contact Us')?></h4>
                                <p>

                                    <strong><?= Yii::t('main','Phone:')?></strong> <?= Yii::t('main','+1 5589 55488 55')?><br>
                                    <strong><?= Yii::t('main','Email:')?></strong> <?= Yii::t('main','info@example.com')?><br>
                                </p>
                            </div>

<!--                            <div class="social-links">-->
<!--                                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>-->
<!--                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>-->
<!--                                <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>-->
<!--                                <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>-->
<!--                            </div>-->

                        </div>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="form">

                        <h4><?= Yii::t('main','Send us a message')?></h4>
                        <p><?= Yii::t('main','Eos ipsa est voluptates. Nostrum nam libero ipsa vero. Debitis quasi sit eaque numquam similique commodi harum aut temporibus.')?></p>
                        <form action="" method="post" role="form" class="contactForm">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="<?= Yii::t('main','Your Name')?>" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="<?= Yii::t('main','Your Email')?>" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="<?= Yii::t('main','Subject')?>" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="<?= Yii::t('main','Message')?>"></textarea>
                                <div class="validation"></div>
                            </div>

                            <div id="sendmessage"><?= Yii::t('main','Your message has been sent. Thank you!')?></div>
                            <div id="errormessage"></div>

                            <div class="text-center"><button type="submit" title="Send Message"><?= Yii::t('main','Send Message')?></button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; <?= Yii::t('main','Copyright')?> <strong>OOO "LANBIR SERVISE"</strong>. <?= Yii::t('main','All Rights Reserved')?>
        </div>
        <div class="credits">

            <?= Yii::t('main','License by ')?> <a href="/img/license.jpg">AA № 0007000</a>
            <?= Yii::t('main','Sertificate by')?> <a href="/img/certificat.jpg">№ 2329011</a>
        </div>
    </div>
</footer><!-- #footer -->

<div style="position: fixed;
    bottom: 30px;
    background-color: #ff00662e;
    right: 60px;
    border-radius: 40px;
    padding-right: 15px;">

    <img src="/img/call.gif" width="80px" style="float: left;">
    <div style="float: right;padding-top: 15px;padding-left: 10px;">
       <div style="font-size: 23px;
line-height: 1;
color:
black;
font-weight: bold;"><?= Yii::t('main','Call markaz')?></div>
       <div style="font-size: 23px;
    font-weight: bold;color:black">71-200-11-22</div>
    </div>
</div>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<script>

</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(56063239, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/56063239" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
