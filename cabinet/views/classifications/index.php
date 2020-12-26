<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ClassificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Classifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-6">
            <div class="page-title m-b-0"><?= $this->title ?></div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <a href="/classifications/get-data" class="btn-gray border-right-0-margin-right-30 color-blue"> <?= Yii::t('main','Import products')?></a>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
            'groupCode',
            'classCode',
            'className',
//            'productCode',
//            'productName',
            //'enabled',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


        </div>
    </div>
</div>





<style>
    .table th, .table td {
        vertical-align: unset !important;
    }
</style>