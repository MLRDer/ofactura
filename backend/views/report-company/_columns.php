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
         'attribute'=>'id',
     ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'parent_id',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tin',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Districts::find()->where("parent_region_id is null")->all(),'region_id','name_uz'),
        'attribute'=>'ns10_code',
        'value'=>function($model){
            return $model['reg_name'];
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\Districts::find()->andWhere(["parent_region_id"=> isset(Yii::$app->request->queryParams['CompanySearch']['ns10_code'])? Yii::$app->request->queryParams['CompanySearch']['ns10_code']:999])->all(),'district_id','name_uz'),
        'attribute'=>'district_id',
        'value'=>function($model){
            return $model['distric_name'];
        }

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'address',
     ],
     [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'invoices_sum',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'created_date',
     ],

    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tarif_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'director_tin',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'director',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'accountant',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'phone',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'type',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'enabled',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'is_aferta',
         'format'=>'html',
         'filter'=>['1'=>'Tadiqlangan'],
         'value'=>function($model){
            $res = "<span class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-ban-circle'></i> </span>";
            if($model->is_aferta==1)
                $res = "<span class='btn btn-success btn-xs'><i class='glyphicon glyphicon-check'></i> </span>";
            return $res;
         }
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'is_online',
         'format'=>'html',
         'filter'=>['1'=>'Tadiqlangan'],
         'value'=>function($model){
             $res = "";
             if($model->is_online==1)
                 $res = "<span class='btn btn-primary btn-xs'><i class='glyphicon glyphicon-check'></i> </span>";
             return $res;
         }
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'count_login',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'aferta_text',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'start_month',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'end_month',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   