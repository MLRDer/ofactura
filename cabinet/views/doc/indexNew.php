<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main','Saqlangan xujjatlar title');
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
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
        <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" id="Combined-Shape-Copy" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero"/>
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
            [
                'headerOptions' => ['style' => 'width:35px'],
                'contentOptions' => ['style'=>'font-weight:bold;text-align:center;'],
                'format'=>'raw',
                'value'=>function($model){

                    $res = "<div  onclick='DelteFac(".$model->id.")' class='btn btn-light btn-elevate-hover btn-circle btn-icon'><i class='flaticon-delete'></i></div>";
                    if($model->status==\common\models\DocStatus::PROVIDED || $model->status==\common\models\DocStatus::ACCEPTED || $model->status==5){
                        $res ="";
                    }

                    if($model->type_doc==\common\models\Docs::TYPE_IN){
                        $res = "";
                    }

                    return $res;
                }
            ],
            [
                'headerOptions' => ['style' => 'width:35px'],
                'contentOptions' => ['style'=>'font-weight:bold;text-align:center;'],
                'format'=>'raw',
                'value'=>function($model){
                        $res = "<a href='/doc/update?id=".$model->id."' class='btn btn-light btn-elevate-hover btn-circle btn-icon'><i class='flaticon-edit'></i></a>";
                    if($model->status==\common\models\DocStatus::PROVIDED || $model->status==\common\models\DocStatus::ACCEPTED || $model->status==5){
                        $res ="";
                    }
                    if($model->type_doc==\common\models\Docs::TYPE_IN){
                        $res = "";
                    }
                    return $res;
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