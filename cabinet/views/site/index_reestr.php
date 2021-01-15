<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReestrMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main','Reestr Mains');
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= GridView::widget([
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

            [
             'attribute'=>'reest_no',
             'format'=>'raw',
             'value'=>function($model){

                return "<a href='/reestr/view?id=".$model['id']."' class='btn btn-light btn-elevate btn-pill'>".$model['reest_no']." </a>";
             }
             ],

            'reestr_date',

            //'created_user',


        ],
    ]); ?>


<style>
    .table th, .table td {
        vertical-align: unset !important;
    }
</style>