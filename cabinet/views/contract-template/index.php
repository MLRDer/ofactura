<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanyPartsTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Company Parts Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-6">
            <div class="page-title m-b-0"><?= $this->title ?></div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <a href="/contract-template/create" class="btn-gray border-right-0-margin-right-30 color-blue">+ <?= Yii::t('main','Создать новую template')?></a>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',

            ],
        ]); ?>
        </div>
    </div>
</div>
