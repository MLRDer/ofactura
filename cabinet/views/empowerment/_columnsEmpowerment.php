<?php


use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
    'tableOptions' => [
        'class' => '',
    ],
    'pager'=>[
        'prevPageLabel'=>'<img src="/new_template/images/icon/arrow-left-blue.svg" alt="">',
        'nextPageLabel'=>'<img src="/new_template/images/icon/arrow-right-blue.svg" alt="">',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label'=>'',
            'format'=>'raw',
            'value'=>function($model){
                return '<label class="star-checkbox">
                                <input type="checkbox" checked="checked">
                                <div class="star"></div>
                            </label>';
            }
        ],
        [
            'attribute' => 'EmpowermentNo',
            'headerOptions' => ['style' => 'width:150px'],
            'format' => 'raw',
            'value' => function ($model) {

                return '<a href="/empowerment/view?id=' . $model->id . '" class="pdf-badge"><img src="/new_template/images/icon/pdf-white.svg" alt=""> <div class="title"> №' . $model->EmpowermentNo . '</div></a>';
            }
        ],
        'AgentTin',

        'AgentFio',

        'SellerTin',
        'SellerName',
        [
            'attribute' => 'status',
            'format' => 'raw',
            'headerOptions' => ['style' => 'width:145px'],
            'value' => function ($model) {

                return \common\models\DocStatus::getStatus($model->status);
            }
        ],
//        [
//            'headerOptions' => ['style' => 'width:35px'],
//            'contentOptions' => ['style' => 'font-weight:bold;text-align:center;'],
//            'format' => 'raw',
//            'value' => function ($model) {
//
//                $res = "<div  onclick='DelteEmp(" . $model->id . ")' class='btn btn-light btn-elevate-hover btn-circle btn-icon'><i class='flaticon-delete'></i></div>";
//                if ($model->status == \common\models\DocStatus::PROVIDED || $model->status == \common\models\DocStatus::ACCEPTED || $model->status == 5) {
//                    $res = "";
//                }
//
//                if ($model->type == \common\models\Docs::TYPE_IN) {
//                    $res = "";
//                }
//
//                return $res;
//            }
//        ],
//        [
//            'headerOptions' => ['style' => 'width:35px'],
//            'contentOptions' => ['style' => 'font-weight:bold;text-align:center;'],
//            'format' => 'raw',
//            'value' => function ($model) {
//
//                $res = "<a href='/empowerment/update?id=" . $model->id . "' class='btn btn-light btn-elevate-hover btn-circle btn-icon'><i class='flaticon-edit'></i></a>";
//                if ($model->status == \common\models\DocStatus::PROVIDED || $model->status == \common\models\DocStatus::ACCEPTED || $model->status == 5) {
//                    $res = "";
//                }
//                if ($model->type == \common\models\Docs::TYPE_IN) {
//                    $res = "";
//                }
//                return $res;
//            }
//        ],


    ],
]);