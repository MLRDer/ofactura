<?php

namespace cabinet\assets;

use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;


/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
//		"themes/vendors/custom/fullcalendar/fullcalendar.bundle.css",
		"themes/vendors/general/perfect-scrollbar/css/perfect-scrollbar.min.rtl.css",
//		"themes/vendors/general/tether/dist/css/tether.css",
//		"themes/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css",
//		"themes/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css",
//		"themes/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css",
//		"themes/vendors/general/bootstrap-daterangepicker/daterangepicker.css",
//		"themes/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css",
//		"themes/vendors/general/bootstrap-select/dist/css/bootstrap-select.css",
		"themes/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css",
//		"themes/vendors/general/select2/dist/css/select2.css",
//		"themes/vendors/general/ion-rangeslider/css/ion.rangeSlider.css",
//		"themes/vendors/general/nouislider/distribute/nouislider.css",



//		"themes/vendors/general/owl.carousel/dist/assets/owl.carousel.css",
//		"themes/vendors/general/owl.carousel/dist/assets/owl.theme.default.css",
//		"themes/vendors/general/dropzone/dist/dropzone.css",
//		"themes/vendors/general/summernote/dist/summernote.css",
//		"themes/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css",
		"themes/vendors/general/animate.css/animate.min.rtl.css",
//		"themes/vendors/general/toastr/build/toastr.css",
//		"themes/vendors/general/morris.js/morris.css",
//		"themes/vendors/general/sweetalert2/dist/sweetalert2.css",
        "/css/sweetalert.css",
		"themes/vendors/general/socicon/css/socicon.css",
		"themes/vendors/custom/vendors/line-awesome/css/line-awesome.css",
		"themes/vendors/custom/vendors/flaticon/flaticon.css",
		"themes/vendors/custom/vendors/flaticon2/flaticon.css",
		"themes/vendors/custom/vendors/fontawesome5/css/all.min.css",
        "themes/demo/demo6/base/style.bundle.css",
        "themes/app/custom/pricing/pricing-v1.demo6.css",
        "css/loading.min.css",
        "css/site.css"
    ];
    public $js = [

//		"themes/vendors/general/popper.js/dist/umd/popper.js",
		"themes/vendors/general/bootstrap/dist/js/bootstrap.min.js",
//		"themes/vendors/general/js-cookie/src/js.cookie.js",
//		"themes/vendors/general/moment/min/moment.min.js",
//		"themes/vendors/general/tooltip.js/dist/umd/tooltip.min.js",
		"themes/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js",
		"themes/vendors/general/sticky-js/dist/sticky.min.js",
//		"themes/vendors/general/wnumb/wNumb.js",
//		"themes/vendors/general/jquery-form/dist/jquery.form.min.js",
//		"themes/vendors/general/block-ui/jquery.blockUI.js",
//		"themes/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
//		"themes/vendors/custom/components/vendors/bootstrap-datepicker/init.js",
//		"themes/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js",
//		"themes/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
//		"themes/vendors/custom/components/vendors/bootstrap-timepicker/init.js",
//		"themes/vendors/general/bootstrap-daterangepicker/daterangepicker.js",
//		"themes/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js",
//		"themes/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js",
//		"themes/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js",
//		"themes/vendors/general/bootstrap-select/dist/js/bootstrap-select.js",
		"themes/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js",
		"themes/vendors/custom/components/vendors/bootstrap-switch/init.js",
//		"themes/vendors/general/select2/dist/js/select2.full.js",
//		"themes/vendors/general/ion-rangeslider/js/ion.rangeSlider.js",
//		"themes/vendors/general/typeahead.js/dist/typeahead.bundle.js",
//		"themes/vendors/general/handlebars/dist/handlebars.js",
		"themes/vendors/general/inputmask/dist/jquery.inputmask.bundle.js",
		"themes/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js",
		"themes/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js",
//		"themes/vendors/general/nouislider/distribute/nouislider.js",
//		"themes/vendors/general/owl.carousel/dist/owl.carousel.js",
//		"themes/vendors/general/autosize/dist/autosize.js",
//		"themes/vendors/general/clipboard/dist/clipboard.min.js",
//		"themes/vendors/general/dropzone/dist/dropzone.js",
//		"themes/vendors/general/summernote/dist/summernote.js",
//		"themes/vendors/general/markdown/lib/markdown.js",
//		"themes/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js",
//		"themes/vendors/custom/components/vendors/bootstrap-markdown/init.js",
		"themes/vendors/general/bootstrap-notify/bootstrap-notify.min.js",
		"themes/vendors/custom/components/vendors/bootstrap-notify/init.js",
//		"themes/vendors/general/jquery-validation/dist/jquery.validate.js",
//		"themes/vendors/general/jquery-validation/dist/additional-methods.js",
//		"themes/vendors/custom/components/vendors/jquery-validation/init.js",
//		"themes/vendors/general/toastr/build/toastr.min.js",
//		"themes/vendors/general/raphael/raphael.js",
//		"themes/vendors/general/morris.js/morris.js",
//		"themes/vendors/general/chart.js/dist/Chart.bundle.js",
//		"themes/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js",
//		"themes/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js",
//		"themes/vendors/general/waypoints/lib/jquery.waypoints.js",
//		"themes/vendors/general/counterup/jquery.counterup.js",
//		"themes/vendors/general/es6-promise-polyfill/promise.min.js",
//		"themes/vendors/general/sweetalert2/dist/sweetalert2.min.js",
//		"themes/vendors/custom/components/vendors/sweetalert2/init.js",
        "/js/sweetalert.js",
//		"themes/vendors/general/jquery.repeater/src/lib.js",
//		"themes/vendors/general/jquery.repeater/src/jquery.input.js",
//		"themes/vendors/general/jquery.repeater/src/repeater.js",
//		"themes/vendors/general/dompurify/dist/purify.js",
    	"themes/demo/demo6/base/scripts.bundle.js",
        "js/sweetalert.js",
//		"themes/vendors/custom/fullcalendar/fullcalendar.bundle.js",
//		"themes/vendors/custom/gmaps/gmaps.js",
		"themes/app/custom/general/dashboard.js",

//        "themes/app/custom/general/crud/metronic-datatable/base/html-table.js",
		"themes/app/bundle/app.bundle.js",
//        'js/e-imzo.js',
//        'js/e-imzo-client.js',
        "js/default.js"

    ];
    public $depends = [
            BootstrapPluginAsset::class
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
