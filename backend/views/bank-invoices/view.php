<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BankInvoicesLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bank Invoices Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bank-invoices-log-view">

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
            'docId',
            'docNumb',
            'currDay',
            'codeFilial',
            'clMfo',
            'clAcc',
            'clInn',
            'clName',
            'coMfo',
            'coAcc',
            'coInn',
            'coName',
            'payPurpose',
            'sumPay',
            'state',
            'operationId',
            'type',
            'enabled',
        ],
    ]) ?>

</div>
