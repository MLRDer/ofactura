<?php

namespace cabinet\assets;

use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;


/**
 * Main backend application asset bundle.
 */
class NewAssetLogin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        "new_template/styles/vendor.min.css",
        "new_template/styles/main.css",
        "css/new_template.css"
    ];
    public $js = [
//        "new_template/scripts/jquery.min.js",
        "new_template/scripts/bootstrap.min.js",
        "new_template/scripts/vendor.min.js",
        "/js/sweetalert.js",
        "new_template/scripts/main.js",

//        'js/e-imzo.js',
//        'js/e-imzo-client.js',
        "js/default.js"

    ];
    public $depends = [
            BootstrapPluginAsset::class,
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
