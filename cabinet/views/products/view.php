<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DocProducts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Doc Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="doc-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'doc_id',
            'SortOreder',
            'ProductName',
            'ProductMeasureId',
            'ProductCount',
            'ProductSumma',
            'ProductDeliverySum',
            'ProductVatRate',
            'ProductVatSum',
            'ProductDeliverySumWithVat',
            'ProductFuelRate',
            'ProductFuelSum',
            'ProductDeliverySumWithFuel',
            'created_date',
            'status',
            'enabled',
        ],
    ]) ?>

</div>
