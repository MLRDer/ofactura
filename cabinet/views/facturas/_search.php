<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FacturasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facturas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'Version') ?>

    <?= $form->field($model, 'FacturaType') ?>

    <?= $form->field($model, 'SingleSidedType') ?>

    <?= $form->field($model, 'FacturaNo') ?>

    <?php // echo $form->field($model, 'FacturaDate') ?>

    <?php // echo $form->field($model, 'ContractNo') ?>

    <?php // echo $form->field($model, 'ContractDate') ?>

    <?php // echo $form->field($model, 'AgentFacturaId') ?>

    <?php // echo $form->field($model, 'EmpowermentNo') ?>

    <?php // echo $form->field($model, 'EmpowermentDateOfIssue') ?>

    <?php // echo $form->field($model, 'AgentFio') ?>

    <?php // echo $form->field($model, 'AgentTin') ?>

    <?php // echo $form->field($model, 'ItemReleasedFio') ?>

    <?php // echo $form->field($model, 'SellerTin') ?>

    <?php // echo $form->field($model, 'BuyerTin') ?>

    <?php // echo $form->field($model, 'SellerName') ?>

    <?php // echo $form->field($model, 'SellerAccount') ?>

    <?php // echo $form->field($model, 'SellerBankId') ?>

    <?php // echo $form->field($model, 'SellerAddress') ?>

    <?php // echo $form->field($model, 'SellerMobile') ?>

    <?php // echo $form->field($model, 'SellerWorkPhone') ?>

    <?php // echo $form->field($model, 'SellerOked') ?>

    <?php // echo $form->field($model, 'SellerDistrictId') ?>

    <?php // echo $form->field($model, 'SellerDirector') ?>

    <?php // echo $form->field($model, 'SellerAccountant') ?>

    <?php // echo $form->field($model, 'SellerVatRegCode') ?>

    <?php // echo $form->field($model, 'SellerBranchCode') ?>

    <?php // echo $form->field($model, 'SellerBranchName') ?>

    <?php // echo $form->field($model, 'BuyerName') ?>

    <?php // echo $form->field($model, 'BuyerAccount') ?>

    <?php // echo $form->field($model, 'BuyerBankId') ?>

    <?php // echo $form->field($model, 'BuyerAddress') ?>

    <?php // echo $form->field($model, 'BuyerMobile') ?>

    <?php // echo $form->field($model, 'BuyerWorkPhone') ?>

    <?php // echo $form->field($model, 'BuyerOked') ?>

    <?php // echo $form->field($model, 'BuyerDistrictId') ?>

    <?php // echo $form->field($model, 'BuyerDirector') ?>

    <?php // echo $form->field($model, 'BuyerAccountant') ?>

    <?php // echo $form->field($model, 'BuyerVatRegCode') ?>

    <?php // echo $form->field($model, 'BuyerBranchCode') ?>

    <?php // echo $form->field($model, 'BuyerBranchName') ?>

    <?php // echo $form->field($model, 'FacturaProductId') ?>

    <?php // echo $form->field($model, 'Tin') ?>

    <?php // echo $form->field($model, 'HasVat') ?>

    <?php // echo $form->field($model, 'HasExcise') ?>

    <?php // echo $form->field($model, 'HasCommittent') ?>

    <?php // echo $form->field($model, 'HasMedical') ?>

    <?php // echo $form->field($model, 'AllSum') ?>

    <?php // echo $form->field($model, 'AllVatSum') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
