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
                    'options' => ['placeholder' => Yii::t('main','Enter factura date ...')],
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
                    'options' => ['placeholder' => Yii::t('main','Enter contract date ...')],
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
                    <input type="text" class="form-control" onkeyup="GetDataByTin(this.value)" placeholder="<?= Yii::t('main','Введите инн...')?>" id="BuyerTin">
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
    $(document).ready(function(){
        var k=document.getElementById('row_value').value;
        $(".add-row").click(function(){

            var ProductName =  '<div class="editable" name="ProductName" id="ProductName_'+k+'" rowid="'+k+'"></div>';
            var ProductCount =  '<div class="editable" name="ProductCount" id="ProductCount_'+k+'" rowid="'+k+'">0</div>';
            var ProductMeasureId =  '<div class="editable" name="ProductMeasureId" id="ProductMeasureId_'+k+'" rowid="'+k+'"></div>';
            var ProductSumma =  '<div class="editable" name="ProductSumma" id="ProductSumma_'+k+'" rowid="'+k+'">0</div>';
            var ProductDeliverySum =  '<div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_'+k+'" rowid="'+k+'">0</div>';
            var ProductVatRate =  '<div class="editable" name="ProductVatRate" id="ProductVatRate_'+k+'" rowid="'+k+'">0</div>';
            var ProductVatSum =  '<div class="editable" name="ProductVatSum" id="ProductVatSum_'+k+'" rowid="'+k+'">0</div>';
            var ProductDeliverySumWithVat =  '<div class="editable" name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVat_'+k+'" rowid="'+k+'">0</div>';

            var ProductFuelRate =  '<div class="editable" name="ProductFuelRate" id="ProductFuelRate_'+k+'" rowid="'+k+'">0</div>';
            var ProductFuelSum =  '<div class="editable" name="ProductFuelSum" id="ProductFuelSum_'+k+'" rowid="'+k+'">0</div>';
            var ProductDeliverySumWithFuel =  '<div class="editable" name="ProductDeliverySumWithFuel" id="ProductDeliverySumWithFuel_'+k+'" rowid="'+k+'">0</div>';

            k++;

            var isAksis = document.getElementById('TypeVat').checked;
            if(isAksis==true){
                var markup = "<tr><td align='center'><label class='kt-checkbox kt-checkbox--brand'><input type='checkbox' name='record'><span style='top: 4px;left: 5px;'></span></label></td><td>" + ProductName + "</td><td>" + ProductMeasureId + "</td><td>"+ProductCount+"</td><td>"+ProductSumma+"</td><td>"+ProductDeliverySum+"</td><td>"+ProductVatRate+"</td><td>"+ProductVatSum+"</td><td>"+ProductDeliverySumWithVat+"</td> <td>"+ ProductFuelRate +"</td><td>"+ProductFuelSum+"</td><td>"+ProductDeliverySumWithFuel+"</td></tr>";
            } else {
                var markup = "<tr><td align='center'><label class='kt-checkbox kt-checkbox--brand'><input type='checkbox' name='record'><span style='top: 4px;left: 5px;'></span></label></td><td>" + ProductName + "</td><td>" + ProductMeasureId + "</td><td>"+ProductCount+"</td><td>"+ProductSumma+"</td><td>"+ProductDeliverySum+"</td><td>"+ProductVatRate+"</td><td>"+ProductVatSum+"</td><td>"+ProductDeliverySumWithVat+"</td>  </tr>";
            }






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
            var is_alcohol = document.getElementById("ExtraValue").value;
            if (is_alcohol==1){
                if(name=="ProductName"){
                    var langs = document.getElementById('langs').value;
                    document.getElementById("val_id").value = row_id;
                    $.ajax({
                        url: "/" + langs + "/extra/alco-extra",  //Server script to process data
                        type: 'POST',
                        data: {'row_id':row_id},
                        datatype:'json',
                        success: function(data) {
                            if(data.success==true){
                                $("#kt_modal_4").modal("show");
                                document.getElementById('ExtraAlcoModalArea').innerHTML = data.html;
                                var ids = document.getElementById("type_product").value;
                                AlcoGeneratForm(ids);
                            }
                        },
                        error: function(data){
                            swal("Xatolik", data.message, "error");
                        },
                    });
                }
            }
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

                if(name!="ProductName") {
                    new_item = $('<input class="editable" id="' + $(this).attr('name') + '_' + row_id + '" onkeyup="CalcList(this,' + row_id + ')"  rowid="' + row_id + '"  name="' + name + '" value="' + $(this).text() + '" >');
                } else {
                    new_item = $('<input class="editable" id="' + $(this).attr('name') + '_' + row_id + '" rowid="' + row_id + '"  name="' + name + '" value="' + $(this).text() + '" >');
                }
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

        $("#docs-file").change(function(e){
            var formData = new FormData($('#w0')[0]);
            $("#UploadBtn").addClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
            $.ajax({
                url: "/doc/import-excel",  //Server script to process data
                type: 'POST',
                // Form data
                data: formData,
                datatype:'json',
                success: function(data) {
                    $("#UploadBtn").removeClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
                    console.log(data.fuel);
                    if(data.success==true){
                        document.getElementById('docs-hasfuel').value = data.fuel;
                        document.getElementById('gridArea').innerHTML = data.html;
                        document.getElementById('items_json').value = data.data;
                    }
                },
                error: function(data){
                    $("#UploadBtn").removeClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
                    console.log(data);
                    data = data.responseJSON;

                    swal("Xatolik", data.message, "error");
                },
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
        });



    });
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
