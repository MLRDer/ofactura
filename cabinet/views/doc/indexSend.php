<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main','Jo`natilgan xujjatlar');
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
        <path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M3,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L3,8 C2.44771525,8 2,7.55228475 2,7 C2,6.44771525 2.44771525,6 3,6 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
        <path d="M10,6 L22,6 C23.1045695,6 24,6.8954305 24,8 L24,16 C24,17.1045695 23.1045695,18 22,18 L10,18 C8.8954305,18 8,17.1045695 8,16 L8,8 C8,6.8954305 8.8954305,6 10,6 Z M21.0849395,8.0718316 L16,10.7185839 L10.9150605,8.0718316 C10.6132433,7.91473331 10.2368262,8.02389331 10.0743092,8.31564728 C9.91179228,8.60740125 10.0247174,8.9712679 10.3265346,9.12836619 L15.705737,11.9282847 C15.8894428,12.0239051 16.1105572,12.0239051 16.294263,11.9282847 L21.6734654,9.12836619 C21.9752826,8.9712679 22.0882077,8.60740125 21.9256908,8.31564728 C21.7631738,8.02389331 21.3867567,7.91473331 21.0849395,8.0718316 Z" id="Combined-Shape" fill="#000000"/>
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
            'BuyerTin',
            [
                'attribute'=>'BuyerName',
                'format'=>'raw',
                'value'=>function($model){
                    return "<b>".$model->BuyerName."</b>";
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