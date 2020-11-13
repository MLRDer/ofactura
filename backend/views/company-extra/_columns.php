<?php
use yii\helpers\Url;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'company_id',
        'format'=>'raw',
        'value'=>function($model){
            $data = \common\models\Company::findOne(['id'=>$model->company_id]);
            return '<a href="/company/view?id='.$model->company_id.'" target="_blank" data-pjax="0">'.$data['name'].'</a>';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'extra_id',
        'value'=>function($model){
            $data = \common\models\ExtraFunction::findOne(['id'=>$model->extra_id]);
            return $data['name_uz'];
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'enabled',
    ],
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