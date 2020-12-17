<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ClassificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Classifications');
$this->params['breadcrumbs'][] = $this->title;
?>


<?php
$formatJs = <<< 'JS'
var formatRepo = function (repo) {
    
    if (repo.loading) {
        return repo.text;
    }
    var markup =
'<div class="row">' + 
    '<div class="col-sm-2">' +
        '<b style="margin-left:5px">' + repo.groupCode + '</b>' + 
    '</div>' +
    '<div class="col-sm-3"><i class="fa fa-code-fork"></i> ' + repo.classCode + '</div>' +
    '<div class="col-sm-6">' + repo.className + '</div>' +
'</div>';
    
    return '<div style="overflow:hidden;">' + markup + '</div>';
};


var formatRepoSelection = function (repo) {
    //concole.log(repo);
    return repo.classCode || repo.text;
}
JS;

// Register the formatting script
$this->registerJs($formatJs, \yii\web\View::POS_HEAD);

// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data, params) {
    params.page = params.page || 1;
    return {
        results: data.items,
        pagination: {
            more: (params.page * 30) < data.total_count
        }
    };
}
JS;

?>




<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L4,21 C2.8954305,21 2,20.1045695 2,19 L2,15 L6.27924078,15 L6.82339262,16.6324555 C7.09562072,17.4491398 7.8598984,18 8.72075922,18 L15.381966,18 C16.1395101,18 16.8320364,17.5719952 17.1708204,16.8944272 L18.118034,15 L22,15 Z" id="Combined-Shape" fill="#000000"/>
        <path d="M2.5625,13 L5.92654389,7.01947752 C6.2807805,6.38972356 6.94714834,6 7.66969497,6 L16.330305,6 C17.0528517,6 17.7192195,6.38972356 18.0734561,7.01947752 L21.4375,13 L18.118034,13 C17.3604899,13 16.6679636,13.4280048 16.3291796,14.1055728 L15.381966,16 L8.72075922,16 L8.17660738,14.3675445 C7.90437928,13.5508602 7.1401016,13 6.27924078,13 L2.5625,13 Z" id="Path" fill="#000000" opacity="0.3"/>
    </g>
</svg>
										</span>
            <h3 class="kt-portlet__head-title">
                <?= $this->title ?>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <a href="/classifications/get-data" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-refresh"></i> 
                            <?= Yii::t('main','Update')?>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
<!--        <div class="row mb-5 mt-3">-->
<!--        <div class="col-md-8 ">-->

            <?php

//            echo \kartik\select2\Select2::widget([
//                'name' => 'kv-repo-template',
//                'value' => '14719648',
//                'options' => ['placeholder' => 'Search for a product ...', 'multiple'=>true],
//                'pluginOptions' => [
//                    'allowClear' => true,
//                    'minimumInputLength' => 1,
//                    'ajax' => [
//                        'url' => \yii\helpers\Url::to('ajax-search'),
//                        'dataType' => 'json',
//                        'delay' => 250,
//                        'data' => new JsExpression('function(params) { return {q:params.term}; }'),
//                        'cache' => true
//                    ],
//                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
//                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
//                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
//                ],
//
//            ]);
            ?>
<!--        </div>-->
<!--            <div class="col-md-4">-->
<!--                <button id="products-add-btn" class="btn btn-brand btn-elevate btn-sm">Qo'shish</button>-->
<!--            </div>-->
<!--        </div>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            'groupCode',
            'classCode',
            'className',
//            'productCode',
//            'productName',
            //'enabled',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    </div>
</div>
<style>
    .table th, .table td {
        vertical-align: unset !important;
    }
</style>

<script>

    $('#products-add-btn').on('click', ()=>{
        let productCodes = $('#w0').val();

        $.ajax({
            'url':'http://cabinet.ahadjon.onlinefactura.uz/ru/classifications/add-class-codes',
            'method': 'POST',
            'data':{
                classCodes: productCodes
            },
            success: data=>{
                console.log(data);
            },
            error: error=>{
                console.log(error);
            }
        })
        console.log(productCodes);
    })

</script>