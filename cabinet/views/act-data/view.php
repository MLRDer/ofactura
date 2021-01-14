<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Acts */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Acts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="acts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Update'), ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('main', 'Delete'), ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('main', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'ActNo',
            'ActDate',
            'ActText',
            'ContractNo',
            'ContractDate',
            'SellerTin',
            'SellerName',
            'BuyerTin',
            'BuyerName',
            'ActProductId',
            'Tin',
            'status',
            'type',
            'created_date',
        ],
    ]) ?>

</div>
