<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BankInvoicesLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-invoices-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'docId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docNumb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currDay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codeFilial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clMfo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clAcc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clInn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coMfo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coAcc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coInn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payPurpose')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sumPay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operationId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'enabled')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
