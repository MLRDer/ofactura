<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BankInvoicesLog */

$this->title = 'Update Bank Invoices Log: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bank Invoices Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bank-invoices-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
