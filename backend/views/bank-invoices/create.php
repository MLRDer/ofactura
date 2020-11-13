<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BankInvoicesLog */

$this->title = 'Create Bank Invoices Log';
$this->params['breadcrumbs'][] = ['label' => 'Bank Invoices Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-invoices-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
