<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BankInvoicesLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bank Invoices Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-invoices-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'docId',
//            'docNumb',

//            'codeFilial',
            //'clMfo',
            //'clAcc',
            'clInn',
            'clName',
            //'coMfo',
            //'coAcc',
//            'coInn',
//            'coName',
            'payPurpose',

            [
                    'attribute'=>'sumPay',
                    'format'=>'html',
                    'value'=>function($model){

                        return "<b>".number_format($model->sumPay/100,2)."</b>";
                    }
            ],
            'state',
            [
            'attribute'=>'currDay',
            'value'=>function($model){
                return date('d.m.Y',strtotime($model['currDay']));
            }
]           ,
            //'operationId',
            'type',
            [
                'label'=>'action',
                'format'=>'raw',
                'value'=>function($model){
                    if($model->type==1)
                        return '<a href="/bank-invoices/add?id='.$model->id.'" class="btn btn-success btn-xs">Add</a>';
                    return "";
                }

            ],
            //'enabled',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
