<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>



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

                    return '<a href="/facturas/view?id='.$model->Id.'" class="btn btn-light btn-elevate btn-pill btn-block"> '.$model->FacturaNo.'</a>';
                }
            ],
            [
                'attribute'=>'ContractNo',
                'headerOptions' => ['style' => 'width:150px'],
            ],
            [
                'attribute'=>'BuyerTin',
                'format'=>'raw',
                'value'=>function($model){

                        return "<b>".$model->BuyerTin."</b>";
                }
            ],
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

                    $res = "<div  onclick='DelteFac(".$model->Id.")' class='btn btn-light btn-elevate-hover btn-circle btn-icon'><i class='flaticon-delete'></i></div>";




                    return $res;
                }
            ],
            [
                'headerOptions' => ['style' => 'width:35px'],
                'contentOptions' => ['style'=>'font-weight:bold;text-align:center;'],
                'format'=>'raw',
                'value'=>function($model){

                        $res = "<a href='/facturas/update?id=".$model->Id."' class='btn btn-light btn-elevate-hover btn-circle btn-icon'><i class='flaticon-edit'></i></a>";

                    return $res;
                }
            ],
        ],
    ]); ?>
