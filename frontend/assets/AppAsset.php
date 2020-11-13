<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
          "https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700",
          "lib/bootstrap/css/bootstrap.min.css",
          "lib/font-awesome/css/font-awesome.min.css",
          "lib/animate/animate.min.css",
          "lib/ionicons/css/ionicons.min.css" ,
          "lib/owlcarousel/assets/owl.carousel.min.css" ,
          "lib/lightbox/css/lightbox.min.css" ,
          "css/style.css",
    ];
    public $js = [
          "lib/jquery/jquery.min.js",
          "lib/jquery/jquery-migrate.min.js",
          "lib/bootstrap/js/bootstrap.bundle.min.js",
          "lib/easing/easing.min.js",
          "lib/mobile-nav/mobile-nav.js",
          "lib/wow/wow.min.js",
          "lib/waypoints/waypoints.min.js",
          "lib/counterup/counterup.min.js",
          "lib/owlcarousel/owl.carousel.min.js",
          "lib/isotope/isotope.pkgd.min.js",
          "lib/lightbox/js/lightbox.min.js",
          "contactform/contactform.js",
          "js/sweetalert.js",
          "js/main.js",

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
