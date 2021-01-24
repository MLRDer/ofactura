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
                        ['class' => 'yii\grid\SerialColumn'],

//                        'Id',
//                        'HasVat',
                        [
                            'attribute'=>'ContractNo',
                            'format'=>'raw',
                            'value'=>function($model){

                                return '<a href="/contracts/view?id='.$model->Id.'" class="pdf-badge"> <img src="/new_template/images/icon/pdf-white.svg" alt=""> <div class="title">№ '.$model->ContractNo.'</div></a>';
                            }
                        ],
                        'ContractName',
//                        'ContractNo',
                        'ContractDate',
//                        'ContractExpireDate',
                        //'ContractPlace',
//                        'Tin',
                        //'Name',
                        //'Address',
                        //'WorkPhone',
                        //'Mobile',
                        //'Fax',
                        //'Oked',
                        //'Account',
                        //'BankId',
                        //'FizTin',
                        //'Fio',
                        //'BranchCode',
                        //'BranchName',
                        //'json_items:ntext',
                        //'clients:ntext',
                        //'parts:ntext',
                        //'status',
                        //'type',
                        //'created_date',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


            </div>

        </div>
    </div>
</div>


