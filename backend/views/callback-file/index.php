<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CallbackFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Callback Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="callback-file-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_date',
            [
                    'attribute'=>'type',
                'format'=>'raw',
                'value'=>function($value){
                    $list = [
                            10=>"Fakturalar",
                            20=>"Akt",
                            30=>"Davernost",

                    ];
                    //var_dump($value["type"]);
                    //die();
                    return $list[$value["type"]];
                }
            ],
            [
                'attribute'=>'path',
                'format'=>'raw',
                'value'=>function($value){

                    //var_dump($file);
                    //die();
                    //var_dump($value["type"]);
                    //die();
                    return "<a class='btn btn-info btn-xs' href='/callback-file/view?id=".$value["id"]."'>File</a>";
                }
            ],
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function($value){
                    $list = [
                        10=>"Yangi",
                        20=>"Import qilingan",
                        30=>"Xatolik yuz bergan",

                    ];
                    //var_dump($value["type"]);
                    //die();
                    return $list[$value["status"]];
                }
            ],
            'reason',
            //'enabled',
            [
                'attribute'=>'type_action',
                'format'=>'raw',
                'value'=>function($value){
                    $list = [
                        10=>"Imzo kutilmoqda",
                        20=>"Qabul qilingan",
                        30=>"Qaytarib yuborilgan",
                        40=>"Bekor qilingan",

                    ];
                    //var_dump($value["type"]);
                    //die();
                    return $list[$value["type_action"]];
                }
            ],

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{view}'
            ],

        ],
    ]); ?>


</div>
