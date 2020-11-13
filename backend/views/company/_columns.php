<?php
use yii\helpers\Url;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
         [
         'class'=>'\kartik\grid\DataColumn',
             'width' => '30px',
         'attribute'=>'id',
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'is_online',
        'label'=>'Check',
        'width' => '10px',
        'format'=>'html',
        'value'=>function($model){
            $res="";
            if($model->is_online==1){
                $res = "<span class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-check'></i></span>";
            }

            return $res;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tin',
        'width' => '90px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'tarif_id',
//        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\CompanyTarif::find()->all(),'id','name'),
//        'width' => '180px',
//        'value'=>function($model){
//            $model = \common\models\CompanyTarif::findOne(['id'=>$model->tarif_id]);
//
//            return $model['name'];
//        }
//    ],
    [
      'attribute'=>'count_login'
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'invoices_sum',
         'width' => '130px',
         'format'=>'raw',
         'value'=>function($model){
            return "<b>".number_format($model->invoices_sum,2)."</b>";
         }
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'format'=>'raw',
         'value'=>function($model){

            return "<a href='/company/view?id=".$model->id."' data-pjax='0' class='btn btn-info btn-xs btn-block'><i class='glyphicon glyphicon-eye-open'></i>  Batafsil</a>";
         }
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'is_aferta',
         'format'=>'raw',
         'width' => '80px',
         'value'=>function($model){

             $res ="<span class='btn btn-warning btn-xs'>Rozi emas</span>";
             if($model->is_aferta==1){
                 $res ="<span class='btn btn-success btn-xs'>Rozi</span>";
             }
             return $res;
         }
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'type',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'enabled',
    // ],


];   