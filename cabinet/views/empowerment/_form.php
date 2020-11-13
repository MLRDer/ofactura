<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Empowerment */
/* @var $form yii\widgets\ActiveForm */
$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name')
?>

<div class="empowerment-form">
    <?php if($error!==""){ ?>

        <div class="alert alert-outline-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
            <div class="alert-text"><?= $error ?> </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
    <?php }?>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'EmpowermentNo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">

            <?php
            echo $form->field($model, 'EmpowermentDateOfIssue')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('main','Enter begin date ...')],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'EmpowermentDateOfExpire')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('main','Enter end date ...')],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'ContractDate')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('main','Enter contract date ...')],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>

        </div>
<div class="col-md-4"></div>
        <div class="kt-divider"style="width: 100%">
            <span></span>
            <span><?= Yii::t('main','Инфрмация сторону')?></span>
            <span></span>
        </div>


        <div class="col-md-6 SallerBuyer">
            <legend style="margin-bottom: 17px"><?= Yii::t('main','Yetkazib beruvchi')?><span class="pull-right" style="float: right;
    border: 1px solid #e2dede;
    padding: 6px 15px;
    border-radius: 5px;
    background-color: #efefef;"><?= \cabinet\models\Components::CompanyData('tin')?> </span> </legend>

            <?= $form->field($model, 'BuyerName')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'BuyerAddress')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'BuyerAccount')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'BuyerBankId')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

            <?= $form->field($model, 'BuyerOked')->textInput(['class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'BuyerDistrictId')->textInput(['class'=>'form-control-plaintext input-sm']) ?>

        </div>


        <div class="col-md-6 SallerBuyer" id="SendLevelArea">

            <div class="row">
                <div class="col-lg-5" style="padding-top: 10px">
                    <legend><?= Yii::t('main','Buyurtmachi')?></legend>
                </div>
                <div class="col-lg-7">
                    <div class="input-group">
                        <input type="text" class="form-control" onkeyup="GetEnviromentDataByTin(this.value)" placeholder="<?= Yii::t('main','Введите инн...')?>" id="EnvBuyerTin">
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-xs" id="SearchEnvBtn" type="button" onclick="GetEnviromentBuyer()"><?= Yii::t('main','Поиск!')?></button>
                        </div>
                    </div>
                </div>
            </div>

            <?= $form->field($model, 'SellerTin')->hiddenInput(['class'=>'form-control-plaintext input-sm'])->label(false) ?>
            <?= $form->field($model, 'SellerName')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'SellerAddress')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'SellerAccount')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'SellerBankId')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'SellerOked')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>
            <?= $form->field($model, 'SellerDistrictId')->textInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm']) ?>

        </div>
        <div class="col-md-6">
            <div class="kt-divider">
                <span></span>
                <span><?= Yii::t('main','Dovernost')?></span>
                <span></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="kt-divider">
                <span></span>
                <span><?= Yii::t('main','Tovari')?></span>
                <span></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'AgentTin')->textInput(['onkeyup'=>'GetAgentTin(this.value)']) ?>
                </div>
                <div class="col-md-8">
                    <?= $form->field($model, 'AgentFio')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'AgentJobTitle')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'AgentPassportNumber')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-8">

                    <?php
                    echo $form->field($model, 'AgentPassportDateOfIssue')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => Yii::t('main','Enter paspsort date ...')],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'AgentPassportIssuedBy')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="40px" rowspan="2"></th>
                        <th rowspan="2"><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
                        <th width="130px" rowspan="2"><?= Yii::t('main','Ед. изм.')?></th>
                        <th width="90px" rowspan="2"><?= Yii::t('main','Кол - во')?></th>
                    </tr>
                </thead>
                <tbody id="productItemsArea">
                <?php if($model->isNewRecord){ ?>
                    <tr>
                        <td align="center">
                            <label class="kt-checkbox kt-checkbox--brand">
                                <input type="checkbox" name="record">
                                <span style="top: 4px;left: 5px;"></span>
                            </label>
                        </td>
                        <td>
                            <div class="editable" name="ProductName" rowid="1"></div>
                        </td>
                        <td>
                            <div class="editable" name="ProductMeasureId" rowid="1"></div>
                        </td>
                        <td>
                            <div class="editable" name="ProductCount" id="ProductCount_1" rowid="1">0</div>
                        </td>
                    </tr>
                <?php } else {
                    $products = \common\models\EmpowermentProduct::findAll(['empowerment_id'=>$model->EmpowermentId]);
                    $n=0;
                    foreach ($products as $items){ $n++;
                    ?>
                    <tr>
                        <td align="center">
                            <label class="kt-checkbox kt-checkbox--brand">
                                <input type="checkbox" name="record">
                                <span style="top: 4px;left: 5px;"></span>
                            </label>
                        </td>
                        <td>
                            <div class="editable" name="ProductName" rowid="<?= $n?>">
                                <?= $items->Name ?>
                            </div>
                        </td>
                        <td>
                            <div class="editable" name="ProductMeasureId" rowid="<?= $n?>">
                                <?= $measure[$items->MeasureId] ?>
                            </div>
                        </td>
                        <td>
                            <div class="editable" name="ProductCount" id="ProductCount_<?= $n?>" rowid="<?= $n?>">
                                <?= $items->Count ?>
                            </div>
                        </td>
                    </tr>
                <?php }}?>
                </tbody>
            </table>

            <input type="hidden" id="row_value" value="2">

            <button type="button" class="delete-row btn btn-danger btn-elevate"><i class="la la-trash-o
"></i> <?= Yii::t('main','Удалить')?></button>
            <span class="pull-right">
            <button type="button" class="add-row btn btn-brand btn-elevate"><i class="la la-plus-circle
"></i> <?= Yii::t('main','Добавить ещё')?></button>
            </span>
        </div>
        <div class="col-md-12">
            <div class="kt-divider">
                <span></span>
                <span><?= Yii::t('main','Руководителы')?></span>
                <span></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?= $form->field($model, 'SellerDirector')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'SellerAccountant')->textInput(['maxlength' => true]) ?>


                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?= $form->field($model, 'BuyerDirector')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'BuyerAccountant')->textInput(['maxlength' => true]) ?>


                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <?php if($model->isNewRecord){ ?>
    <?= $form->field($model, 'items_json')->hiddenInput(['id' => 'items_json','value'=>'{}'])->label(false) ?>

    <?php }else{ ?>
        <?= $form->field($model, 'items_json')->hiddenInput(['id' => 'items_json'])->label(false) ?>
    <?php }?>
    <?php ActiveForm::end(); ?>

</div>

<script>
    $(document).ready(function(){
        var k=2;
        $(".add-row").click(function(){

            var ProductName =  '<div class="editable" name="ProductName" id="ProductName_'+k+'" rowid="'+k+'"></div>';
            var ProductCount =  '<div class="editable" name="ProductCount" id="ProductCount_'+k+'" rowid="'+k+'">0</div>';
            var ProductMeasureId =  '<div class="editable" name="ProductMeasureId" id="ProductMeasureId_'+k+'" rowid="'+k+'"></div>';
            k++;
            var markup = "<tr><td align='center'><label class='kt-checkbox kt-checkbox--brand'><input type='checkbox' name='record'><span style='top: 4px;left: 5px;'></span></label></td><td>" + ProductName + "</td><td>" + ProductMeasureId + "</td><td>"+ProductCount+"</td></tr>";
            $("table tbody").append(markup);
            // e.preventDefault();
        });

        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });

        var row_id = 0;

        $(document).on("click",".editable",function () {
            // console.log("sdfgsdfg");
            row_id = $(this).attr('rowid');
            var name = $(this).attr('name');
            if(name=="ProductMeasureId"){
                if(!$(this).is("select")) {
                    $.ajax({
                        url: '/api/get-measure',
                        async: false,
                        success: function (data) {
                            new_item = $('<select class="editable" id="' + $(this).attr('name') + '_' + row_id + '" rowid="' + row_id + '"  name="' + name + '" >' + data + ' </select>');
                        },
                        error: function (data) {
                            ShowMessage('danger', 'Remote connection failed. Check internet connection !!!');
                        }
                    });
                    $(this).replaceWith(new_item);
                    new_item.trigger('focus');
                }
            } else {
                new_item = $('<input class="editable" id="' + $(this).attr('name') + '_' + row_id + '" rowid="' + row_id + '"  name="' + name + '" value="' + $(this).text() + '" >');
                $(this).replaceWith(new_item);
                new_item.trigger('focus');
            }

        });

        $(document).on('focusout',".editable",function (e) {
            var list_data = {};
            // console.log(e.target.name);
            var data = $("#items_json").val();
            data = JSON.parse(data);
            if( data[row_id] == undefined ) {
                data[row_id] = {};
                console.log(data[row_id]);
                console.log("Empty");
            }else {
                console.log("Have");
                list_data = data[row_id];
            }
            var key = $(this).attr('name');
            var new_data = {[key]: $(this).val()};
            list_data[key] = $(this).val();
            // console.log(list_data);
            data[row_id] = list_data;
            // data[row_id] = {...data[row_id], ...new_data};
            // data[row_id] = "{"+data[row_id]+","+new_data+"}";
            console.log(data[row_id]);
            var id_txt = key+'_'+row_id;
            if(key=="ProductMeasureId") {
                new_item = $('<div class="editable"  name="' + $(this).attr('name') + '" rowid="' + row_id + '">' + $(this).find("option:selected").text() + '</div>');
            } else {
                new_item = $('<div class="editable" id="'+id_txt+'" name="' + $(this).attr('name') + '" rowid="' + row_id + '">' + $(this).val() + '</div>');
            }
            $(this).replaceWith(new_item);
            // console.log(JSON.stringify(data));
            $("#items_json").val(JSON.stringify(data));
        });
    });
</script>

<style>
    .SallerBuyer .form-control-plaintext{
        float:right;
        width: 50%;
        padding:0px!important;
        border-bottom: 1px solid #cecece;
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
