<?php
/**
 * Created by PhpStorm.
 * User: Jasmina
 * Date: 12.12.2020
 * Time: 20:13
 */
use yii\grid\GridView;
?>
<div class="row">
    <div class="col-md-12">
        <div class="invoices-wrapper">
            <div class="header">
                <div class="row justify-content-between m-b-20">
<!--                    <div class="col-md-4">-->
<!--                        <form action="">-->
<!--                            <div class="input plus-button">-->
<!--                                <button>-->
<!--                                    <img src="/new_template/images/icon/search.svg" alt="">-->
<!--                                </button>-->
<!--                                <input type="text" placeholder="Найти">-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                    <div class="col-md-2">-->
<!--                         -->
<!--                        <div class="btn-outline-gray color-gray d-flex justify-content-start align-items-center">-->
<!--                            <img src="/new_template/images/icon/filtration.svg" alt="" class="m-r-10">Отфильтровать</div>-->
<!--                    </div>-->
                </div>
            </div>
            <div class="body m-b-20">


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,

                    'tableOptions' => [
                        'class' => '',
                    ],
                    'pager'=>[
                        'prevPageLabel'=>'<img src="/new_template/images/icon/arrow-left-blue.svg" alt="">',
                        'nextPageLabel'=>'<img src="/new_template/images/icon/arrow-right-blue.svg" alt="">',
                    ],
//                    'rowOptions'=>function($model){
//                        if($model->is_view == 1){
//                            return ['class' => 'bold-text'];
//                        }
//                    },
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header'=>'№',
                            'headerOptions' => ['style' => 'width:40px'],
                            'contentOptions' => ['style'=>'font-weight:bold;text-align:center;'],
                        ],
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
                            'attribute'=>'FacturaNo',
                            'format'=>'raw',
                            'value'=>function($model){

                                return '<a href="/facturas/view?id='.$model->Id.'" class="pdf-badge"> <img src="/new_template/images/icon/pdf-white.svg" alt=""> <div class="title">№ '.$model->FacturaNo.'</div></a>';
                            }
                        ],
                        [
                            'attribute'=>'ContractNo',
                            'headerOptions' => ['style' => 'width:190px'],
                            'value'=>function($model){
                                return "№ ".$model->ContractNo;
                            }
                        ],
                        [
                            'attribute'=>'BuyerTin',
                            'headerOptions' => ['style' => 'width:190px'],
                            'format'=>'raw',
                            'value'=>function($model){
                                if($model->SellerTin==\cabinet\models\Components::CompanyData('tin'))
                                    return $model->BuyerTin;
                                else
                                    return $model->SellerTin;
                            }
                        ],
                        [
                            'attribute'=>'BuyerName',
                            'format'=>'raw',
                            'value'=>function($model){
                                if($model->SellerTin==\cabinet\models\Components::CompanyData('tin'))
                                    return $model->BuyerName;
                                else
                                    return $model->SellerName;
                            }
                        ],
//                [
//                    'attribute'=>'created_date',
//                    'headerOptions' => ['style' => 'width:150px'],
//                    'value'=>function($model){
//
//                        return date('d.m.Y, H:i',strtotime($model->created_date));
//                    }
//                ],
                        [
                            'attribute'=>'status',
                            'format'=>'html',
                            'headerOptions' => ['style' => 'width:95px'],
                            'value'=>function($model){

                                return \common\models\Facturas::getStatus($model->status,2);
                            }
                        ],



                    ],
                ]); ?>


            </div>

        </div>
    </div>
</div>


