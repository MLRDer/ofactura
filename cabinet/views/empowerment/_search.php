<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmpowermentSaerch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empowerment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>



    <div class="collapse" id="collapseExample" style="margin-top:10px;">
        <div class="card card-body">
    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'EmpowermentNo') ?>

    <?= $form->field($model, 'EmpowermentDateOfIssue') ?>

    <?= $form->field($model, 'EmpowermentDateOfExpire') ?>

    <?php // echo $form->field($model, 'ContractNo') ?>

    <?php // echo $form->field($model, 'ContractDate') ?>

    <?php // echo $form->field($model, 'AgentTin') ?>

    <?php // echo $form->field($model, 'AgentJobTitle') ?>

    <?php // echo $form->field($model, 'AgentPassportNumber') ?>

    <?php // echo $form->field($model, 'AgentFio') ?>

    <?php // echo $form->field($model, 'AgentPassportDateOfIssue') ?>

    <?php // echo $form->field($model, 'AgentPassportIssuedBy') ?>

    <?php // echo $form->field($model, 'SellerTin') ?>

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

    <?php // echo $form->field($model, 'BuyerTin') ?>

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

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
