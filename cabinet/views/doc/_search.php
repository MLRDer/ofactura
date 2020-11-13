<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>



    <div class="collapse" id="collapseExample" style="margin-top:10px;">
        <div class="card card-body">
            <div class="row">

                <div class="col-md-2">
                    <?= $form->field($model, 'FacturaNo') ?>
                </div>
                <div class="col-md-4">

                    <?php
                    echo $form->field($model, 'FacturaDate')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => Yii::t('main','Enter date ...')],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'ContractNo') ?>
                </div>
                <div class="col-md-4">

                    <?php
                    echo $form->field($model, 'ContractDate')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => Yii::t('main','Enter date ...')],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'BuyerName') ?>
                </div>
                <div class="col-md-4">
                    <?php  echo $form->field($model, 'BuyerTin') ?>
                </div>
                <div class="col-md-2" style="padding-top: 33px;">
                    <?= Html::submitButton(Yii::t('main','Search'), ['class' => 'btn btn-success btn-block']) ?>

                </div>

            </div>

        </div>
    </div>











    <?php // echo $form->field($model, 'EmpowermentNo') ?>

    <?php // echo $form->field($model, 'EmpowermentDateOfIssue') ?>

    <?php // echo $form->field($model, 'AgentFio') ?>

    <?php // echo $form->field($model, 'AgentTin') ?>

    <?php // echo $form->field($model, 'ItemReleasedFio') ?>





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

    <?php // echo $form->field($model, 'docs_pks7') ?>

    <?php // echo $form->field($model, 'json_data') ?>

    <?php // echo $form->field($model, 'json_items') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'send_date') ?>

    <?php // echo $form->field($model, 'accepted_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <?php // echo $form->field($model, 'user_id') ?>



    <?php ActiveForm::end(); ?>

</div>
