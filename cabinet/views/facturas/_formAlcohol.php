<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Docs */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="docs-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col-md-12">
        <?= \common\widgets\Alert::widget()?>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'FacturaNo')->textInput(['maxlength' => true,'recured']) ?>
            </div>
            <div class="col-md-3">
                <?php
                echo $form->field($model, 'FacturaDate')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter factura date ...'),'value'=>date('Y-m-d')],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
                ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-3">
                <?php
                echo $form->field($model, 'ContractDate')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter contract date ...'),'value'=>date('Y-m-d')],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
                ?>
            </div>

        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="kt-divider"style="width: 100%">
        <span></span>
        <span><?= Yii::t('main','Инфрмация сторону')?></span>
        <span></span>
    </div>

    <div class="col-md-6 SallerBuyer">
        <legend style="margin-bottom: 17px"><?= Yii::t('main','Yetkazib beruvchi')?></legend>

        <?= $form->field($model, 'SellerName')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'SellerAddress')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'SellerAccount')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'SellerBankId')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'SellerOked')->textInput(['class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'SellerVatRegCode')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

    </div>
    <div class="col-md-6 SallerBuyer" id="SendLevelArea">

        <div class="row">
            <div class="col-lg-5" style="padding-top: 10px">
                <legend><?= Yii::t('main','Buyurtmachi')?></legend>
            </div>
            <div class="col-lg-7">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="<?= Yii::t('main','Введите инн...')?>" id="BuyerTin">
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-xs" id="SearchBtn" type="button" onclick="GetBuyer()"><?= Yii::t('main','Поиск!')?></button>
                    </div>
                </div>
            </div>
        </div>
        <?= $form->field($model, 'BuyerTin')->hiddenInput(['class'=>'form-control-plaintext input-sm'])->label(false) ?>

        <?= $form->field($model, 'BuyerName')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'BuyerAddress')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'BuyerAccount')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'BuyerBankId')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'BuyerOked')->textInput(['class'=>'form-control-plaintext input-sm']) ?>

        <?= $form->field($model, 'BuyerDistrictId')->hiddenInput(['class'=>'form-control-plaintext input-sm'])->label(false) ?>

        <?= $form->field($model, 'BuyerDirector')->hiddenInput(['maxlength' => true])->label(false) ?>

        <?= $form->field($model, 'BuyerAccountant')->hiddenInput(['maxlength' => true])->label(false) ?>

        <?= $form->field($model, 'BuyerVatRegCode')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
    </div>

    <div class="kt-divider"style="width: 100%;margin-top: 20px">
        <span></span>
        <span><?= Yii::t('main','Список товаров')?></span>
        <span></span>
    </div>
    <div class="col-md-12" style="padding-top: 20px">
        <?= $form->field($model, 'HasFuel')->hiddenInput(['maxlength' => true])->label(false) ?>
        <div class="kt-section__content kt-section__content--solid">
            <label class="btn btn-brand " id="UploadBtn">
                <i class="flaticon-attachment"></i> <?= Yii::t('main','Exel to import btn')?>
                <input type="file" id="docs-file" name="Docs[file]" hidden>
            </label>
            <a href="/docs/Шаблон сч.фактура.xlsx" class=" btn btn-warning" style="margin-bottom: 7px;"> <?= Yii::t('main','Skachat factura')?></a>


            <span class="pull-right">
                <div class="row">
                    <label class="col-8 col-form-label"><?= Yii::t('main','акцизного налога')?></label>
                    <div class="col-4">
                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                            <label>
                                <input onclick="SwitchVat(<?= $model->id?>)" type="checkbox" id="TypeVat" <?= $model->HasFuel==1?'checked="checked"':'' ?>  name="">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </span>

            <div id="gridArea">
                <?php if($model->HasFuel){ ?>
            <?= $this->render('_gridWithFuel',['model'=>$model])?>
                <?php } else {?>
                    <?= $this->render('_gridWithOutFuel',['model'=>$model])?>
                <?php }?>
            </div>
            <button type="button" class="delete-row btn btn-danger btn-elevate"><i class="la la-trash-o
"></i> <?= Yii::t('main','Удалить')?></button>
            <span class="pull-right">
            <button type="button" class="add-row btn btn-brand btn-elevate"><i class="la la-plus-circle
"></i> <?= Yii::t('main','Добавить ещё')?></button>
            </span>



            <div class="kt-divider">
                <span></span>
                <span><?= Yii::t('main','Руководитель и доверенност')?></span>
                <span></span>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <?= $form->field($model, 'SellerDirector')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'SellerAccountant')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'ItemReleasedFio')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'EmpowermentNo')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        echo $form->field($model, 'EmpowermentDateOfIssue')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => Yii::t('main','Enter date ...'),'value'=>date('Y-m-d')],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'todayHighlight' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <?= $form->field($model, 'AgentFio')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'AgentTin')->textInput() ?>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>

</div>

    <?php if($model->isNewRecord){ ?>

    <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json",'value'=>"{}"])->label(false) ?>

    <?php } else {?>

        <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json"])->label(false) ?>

    <?php }?>

    <?php ActiveForm::end(); ?>

</div>
<script>

</script>


<style>
    .SallerBuyer .form-control-plaintext{
        float:right;
        width: 50%;
        padding:0px!important;
    }
    .SallerBuyer .form-group{
        margin-bottom:0px;
    }
    .SallerBuyer .form-group label {
        font-size: 1.1rem;
        font-weight: 400;
        float:left;
        width: 45%;
        color:black;
        margin-bottom: 0px;
        padding-top: 0px;
    }

    .Aksis{
        display:<?= $model->HasFuel==1?'revert':'none'?>;
    }

    .SallerBuyer .help-block{
        clear: both;
    }
    table tbody tr td{
        padding:0px!important;
    }

    table thead tr th{
        text-align: center;
    }
    table tbody tr td div{
        /*border: 1px solid #e8e3e3;*/
        padding:8px 3px;
        height: 35px;
    }
    table tbody tr td input, select{
        width:100%;
        height:35px;
        padding-left:3px;
        border:0px;
    }
</style>
