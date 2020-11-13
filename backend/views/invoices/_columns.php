<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
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
        'attribute'=>'company_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type_invoices',
        'width' => '140px',
        'filter'=>$type_invoices = [
            1=>"Xisobni to`ldirish",
            0=>"To`lov"
        ],
        'value'=>function($model){
            $type_invoices = [
              1=>"Xisobni to`ldirish",
              0=>"To`lov"
            ];

            return $type_invoices[$model->type_invoices];
        }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'value',
        'width' => '100px',
        'format'=>'raw',
        'value'=>function($model){
            return "<b>".number_format($model->value,2)."</b>";
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tarif_id',
        'width' => '160px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'created_date',
        'width' => '160px',
        'value'=>function($model){
            return date('d.m.Y H:i',strtotime($model->created_date));
        }
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'type_pay',
         'value'=>function($model){
            $type_pay=[
                1=>'Payme',
                2=>'Aloqabank',
                3=>'Ruchnoy'
            ];
            return (isset($type_pay[$model->type_pay]))?$type_pay[$model->type_pay]:'';
         }
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'status',
         'format'=>'raw',
         'value'=>function($model){
          $btn = '<a href="/invoices/cancel?id='.$model->id.'" class="btn btn-danger btn-xs"> Bekor qilish</a>';
          return $btn;
         }
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'enabled',
    // ],


];   