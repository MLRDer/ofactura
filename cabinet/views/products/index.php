<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DocProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doc Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Doc Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'doc_id',
            'SortOreder',
            'ProductName',
            //'ProductMeasureId',
            //'ProductCount',
            //'ProductSumma',
            //'ProductDeliverySum',
            //'ProductVatRate',
            //'ProductVatSum',
            //'ProductDeliverySumWithVat',
            //'ProductFuelRate',
            //'ProductFuelSum',
            //'ProductDeliverySumWithFuel',
            //'created_date',
            //'status',
            //'enabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
