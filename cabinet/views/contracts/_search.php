<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContractsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contracts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'HasVat') ?>

    <?= $form->field($model, 'ContractName') ?>

    <?= $form->field($model, 'ContractNo') ?>

    <?= $form->field($model, 'ContractDate') ?>

    <?php // echo $form->field($model, 'ContractExpireDate') ?>

    <?php // echo $form->field($model, 'ContractPlace') ?>

    <?php // echo $form->field($model, 'Tin') ?>

    <?php // echo $form->field($model, 'Name') ?>

    <?php // echo $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'WorkPhone') ?>

    <?php // echo $form->field($model, 'Mobile') ?>

    <?php // echo $form->field($model, 'Fax') ?>

    <?php // echo $form->field($model, 'Oked') ?>

    <?php // echo $form->field($model, 'Account') ?>

    <?php // echo $form->field($model, 'BankId') ?>

    <?php // echo $form->field($model, 'FizTin') ?>

    <?php // echo $form->field($model, 'Fio') ?>

    <?php // echo $form->field($model, 'BranchCode') ?>

    <?php // echo $form->field($model, 'BranchName') ?>

    <?php // echo $form->field($model, 'json_items') ?>

    <?php // echo $form->field($model, 'clients') ?>

    <?php // echo $form->field($model, 'parts') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
