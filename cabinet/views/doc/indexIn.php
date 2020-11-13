<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Kelib tushgan xujjatlar');
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'FacturaNo',
    'ContractNo',
    'BuyerTin',
    'BuyerName',
    'created_date',
];


?>


    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
        <path d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z" id="Combined-Shape" fill="#000000"/>
    </g>
</svg>
										</span>
                <h3 class="kt-portlet__head-title">
                    <?= $this->title?>

                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <a href="/doc/create" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                <?= Yii::t('main','Yaratish factura2')?>
                            </a>
                            <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="la la-filter"></i>
                                <?= Yii::t('main','Filter search')?>
                            </button>
                            <?= \cabinet\widgets\LimiterPage::widget() ?>
                            <?= ExportMenu::widget([
                                'dataProvider' => $dataProvider,
                                'columns' => $gridColumns
                            ]);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width:40px'],
                'contentOptions' => ['style'=>'font-weight:bold;text-align:center;'],
            ],
            [
                'attribute'=>'FacturaNo',
                'headerOptions' => ['style' => 'width:150px'],
                'format'=>'raw',
                'value'=>function($model){

                    return '<a href="/doc/view?id='.$model->id.'" class="btn btn-light btn-elevate btn-pill btn-block"><i class="flaticon-attachment"></i> '.$model->FacturaNo.'</a>';
                }
            ],
            [
                'attribute'=>'ContractNo',
                'headerOptions' => ['style' => 'width:150px'],
            ],
            'SellerTin',
            [
                'attribute'=>'BuyerName',
                'format'=>'raw',
                'value'=>function($model){
                    return "<b>".$model->SellerName."</b>";
                 }
            ],
            [
                'attribute'=>'created_date',
                'headerOptions' => ['style' => 'width:150px'],
                'value'=>function($model){

                    return date('d.m.Y, H:i',strtotime($model->created_date));
                }
            ],
            [
                'attribute'=>'status',
                'format'=>'raw',
                'headerOptions' => ['style' => 'width:145px'],
                'value'=>function($model){
                    $statuModel = \common\models\DocStatus::findOne(['id'=>$model->status]);
                    $html = '<span class="kt-badge  kt-badge--'.$statuModel['class_name'].' kt-badge--inline kt-badge--pill">'.$statuModel['name_'.Yii::$app->language].'</span>';
                    return $html;
                }
            ],

        ],
    ]); ?>

        </div>
</div>
<style>
    .table th, .table td {
        vertical-align: unset !important;
    }
</style>