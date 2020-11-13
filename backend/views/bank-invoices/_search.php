<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BankInvoicesLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-invoices-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'docId') ?>

    <?= $form->field($model, 'docNumb') ?>

    <?= $form->field($model, 'currDay') ?>

    <?= $form->field($model, 'codeFilial') ?>

    <?php // echo $form->field($model, 'clMfo') ?>

    <?php // echo $form->field($model, 'clAcc') ?>

    <?php // echo $form->field($model, 'clInn') ?>

    <?php // echo $form->field($model, 'clName') ?>

    <?php // echo $form->field($model, 'coMfo') ?>

    <?php // echo $form->field($model, 'coAcc') ?>

    <?php // echo $form->field($model, 'coInn') ?>

    <?php // echo $form->field($model, 'coName') ?>

    <?php // echo $form->field($model, 'payPurpose') ?>

    <?php // echo $form->field($model, 'sumPay') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'operationId') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
