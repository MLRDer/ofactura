<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Facturas */
/* @var $form yii\widgets\ActiveForm */


?>
<!--<script>-->
<!--    SwitchVat();-->
<!--</script>-->


<div class="facturas-form">

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
            <?= $form->field($model, 'FacturaType')->dropDownList(['0' => "Стандартный",'1'=>"Дополнительный",'2'=>'Возмещение расходов','3'=>'Без оплаты','4'=>'Исправленный'],['onchange'=>'ChangeTypeFactura(this.value)']) ?>

            </div>
            <div class="col-md-9" style="display:none;" id="old_factura_area">
                <div class="col-md-4">
                    <?= $form->field($model, 'OldFacturaId')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'OldFacturaNo')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?php
                    echo $form->field($model, 'OldFacturaDate')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => Yii::t('main','Enter factura date ...')],
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
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


        <div class="col-md-6">
            <div class="col-md-6">
                <?= $form->field($model, 'FacturaNo')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?php
                echo $form->field($model, 'FacturaDate')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter factura date ...')],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-6">
                <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?php
                echo $form->field($model, 'ContractDate')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter contract date ...')],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
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


    <div class="row">
        <div class="col-md-6">
            <div class="kt-widget1 animated fadeInUp">
                <div class="kt-widget1__item">
                    <div class="kt-widget1__info">
                        <h3 class="kt-widget1__title">&#65279;Буюртмачи номи</h3>
                        <span class="kt-widget1__desc"><?= $model->SellerName ?></span>
                    </div>
                    <!--        <span class="kt-widget1__number kt-font-brand">+$17,800</span>-->
                </div>
                <div class="kt-widget1__item">
                    <div class="kt-widget1__info">
                        <h3 class="kt-widget1__title">Ҳисоб рақами:</h3>
                        <span class="kt-widget1__desc"><?= $model->SellerAccount ?></span>
                    </div>
                    <!--        <span class="kt-widget1__number kt-font-danger">+1,800</span>-->
                </div>
                <div class="kt-widget1__item">
                    <div class="kt-widget1__info">
                        <h3 class="kt-widget1__title">МФО</h3>
                        <span class="kt-widget1__desc"><?= $model->SellerBankId ?></span>
                    </div>
                </div>
                <div class="kt-widget1__item">
                    <div class="kt-widget1__info">
                        <h3 class="kt-widget1__title">Манзил:</h3>
                        <span class="kt-widget1__desc"><?= $model->SellerAddress ?></span>
                    </div>
                </div>
                <div class="kt-widget1__item">
                    <div class="kt-widget1__info">
                        <h3 class="kt-widget1__title">ИФУТ</h3>
                        <span class="kt-widget1__desc"><?= $model->SellerOked ?></span>
                    </div>
                </div>

                <div class="kt-widget1__item">
                    <div class="kt-widget1__info">
                        <h3 class="kt-widget1__title">ККС туловчисининг коди</h3>
                        <span class="kt-widget1__desc"><?= $model->SellerVatRegCode ?></span>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-md-6">
            <div id="SendLevelArea">
            <div class="col-md-4">
                <div class="form-group">
                <input type="text" class="form-control shadow-lg" onkeyup="GetDataByTinV2(this.value)" placeholder="<?= Yii::t('main','Введите инн...')?>" id="BuyerTin">
                </div>
                <?= $form->field($model, 'BuyerTin')->hiddenInput()->label(false) ?>
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-12" id="BuyerInfoArea">

            </div>

            </div>
            <div class="col-md-12">

            <div id="SingleSidedType" style="display: none">
                <?= $form->field($model, 'SingleSidedType')->dropDownList(['0'=>'Выбрате','1'=>'На физ. лицо','2'=>'На экспорт','3'=>'На импорт','4'=>'Реализация, связанная с гос. секретом','5'=>'Финансовые услуги']) ?>
            </div>
            </div>
        </div>

    </div>


    <div class="kt-divider"style="width: 100%">
        <span></span>
        <span><?= Yii::t('main','Factura tipini tanlang')?></span>
        <span></span>
    </div>


    <div class="row">
    <div class="col-md-12 " style="padding-top: 20px">
        <div class="col-md-8">
            <div class="btn-group" role="group" aria-label="Default button group">
            </div>
        </div>
        <div class="col-md-4" style="text-align: right">
            <label class="btn btn-brand " id="UploadBtn">
                <i class="flaticon-attachment"></i> <?= Yii::t('main','Exel to import btn')?>
                <input type="file" id="docs-file" name="Facturas[file]" hidden>
            </label>
            <a href="/docs/faktura_all_template.xlsx" class=" btn btn-warning"> <?= Yii::t('main','Skachat factura')?></a>
        </div>
    </div>

        <div class="col-md-12" id="gridArea" style="padding-top: 20px">
            <?= $this->render("/api-v2/_gridWithFuel",['model'=>$model])?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <?= $form->field($model, 'SellerDirector')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'SellerAccountant')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'ItemReleasedFio')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <label onclick="EmpSwitchWithLabel()" class="col-md-3 col-form-label"><?= Yii::t('main','Доверенность')?></label>
                <div class="col-md-3" style="padding-top: 7px;">
                <span class="kt-switch kt-switch--sm kt-switch--icon">
                    <label onclick="EmpSwitch()">
                        <input type="checkbox" id="EmpSwitcher">
                        <span></span>
                    </label>
                </span>
                </div>

                <div class="col-md-12 animated fadeInUp" style="display: none" id="EmpArea">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">
                                <?= Yii::t('main','Ishonchnoma elektron ravishda taqdim qilingan bo`lishi lozim.')?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'EmpowermentNo')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-8">
                            <?php
                            echo $form->field($model, 'EmpowermentDateOfIssue')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => Yii::t('main','Enter date ...'),'value'=>date('Y-m-d')],
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'todayHighlight' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'AgentFio')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'AgentTin')->textInput() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?= $form->field($model, 'BuyerName')->hiddenInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm'])->label(false) ?>

    <?= $form->field($model, 'BuyerAddress')->hiddenInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm'])->label(false) ?>

    <?= $form->field($model, 'BuyerAccount')->hiddenInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm'])->label(false) ?>

    <?= $form->field($model, 'BuyerBankId')->hiddenInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm'])->label(false) ?>

    <?= $form->field($model, 'BuyerOked')->hiddenInput(['class'=>'form-control-plaintext input-sm'])->label(false) ?>

    <?= $form->field($model, 'BuyerDistrictId')->hiddenInput(['class'=>'form-control-plaintext input-sm'])->label(false) ?>

    <?= $form->field($model, 'BuyerDirector')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'BuyerAccountant')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'BuyerVatRegCode')->hiddenInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm'])->label(false) ?>



    <?php if($model->isNewRecord || $model->json_items==""){ ?>

         <?= $form->field($model, 'json_items')->textInput(['id' => "items_json",'value'=>"{}"])->label(false) ?>

    <?php } else {?>

        <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json"])->label(false) ?>

    <?php }?>

<div class="col-md-12 bottom-btn-bar">
    <div class="form-group">
        <span class="pull-right">
            <div class="btn-group">
            <?= Html::submitButton('<i class="flaticon-attachment"></i> '.Yii::t('main', 'Save'), ['class' => 'btn btn-success btn-elevate']) ?>
                </div>
        </span>

    </div>
</div>


</div>
<style>
    .form-group label {
        /*font-family: Montserrat;*/
        text-transform: uppercase;
        color: #f7975c;
        font-weight: 600;
        font-size: 12px;
        line-height: 20px;
        position: relative;
        top: 17px;
        left: 15px;
        background-color: #fff;
        padding-right: 5px;
        padding-bottom: 0px;
        z-index: 10;
        padding-left: 5px;
    }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 20px 20px;
        /*font-family: Montserrat;*/
        font-size: 16px;
        line-height: 20px;
        color: #848e9f;
        border: 1px solid #1e2d55;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
    }
</style>

<script>
    $(document).ready(function(){
        var k=document.getElementById('row_value').value;
        $(".add-row").click(function(){

            var ProductName =  '<div class="editable" name="ProductName" id="ProductName_'+k+'" rowid="'+k+'"></div>';
            var ProductCount =  '<div class="editable" name="ProductCount" id="ProductCount_'+k+'" rowid="'+k+'">0</div>';
            var ProductMeasureId =  '<div class="editable" name="ProductMeasureId" id="ProductMeasureId_'+k+'" rowid="'+k+'"></div>';
            var ProductCatalogName =  '<div class="editable" name="ProductCatalogName" id="ProductCatalogName_'+k+'" rowid="'+k+'"></div>';
            var ProductCatalogCode =  '<div class="editable" name="ProductCatalogCode" id="ProductCatalogCode_'+k+'" rowid="'+k+'"></div>';
            var ProductSumma =  '<div class="editable" name="ProductSumma" id="ProductSumma_'+k+'" rowid="'+k+'">0</div>';
            var ProductDeliverySum =  '<div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_'+k+'" rowid="'+k+'">0</div>';
            var ProductVatRate =  '<div class="editable" name="ProductVatRate" id="ProductVatRate_'+k+'" rowid="'+k+'">0</div>';
            var ProductVatSum =  '<div class="editable" name="ProductVatSum" id="ProductVatSum_'+k+'" rowid="'+k+'">0</div>';
            var ProductDeliverySumWithVat =  '<div class="editable" name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVat_'+k+'" rowid="'+k+'">0</div>';

            var ProductFuelRate =  '<div class="editable" name="ProductFuelRate" id="ProductFuelRate_'+k+'" rowid="'+k+'">0</div>';
            var ProductFuelSum =  '<div class="editable" name="ProductFuelSum" id="ProductFuelSum_'+k+'" rowid="'+k+'">0</div>';
            var ProductDeliverySumWithFuel =  '<div class="editable" name="ProductDeliverySumWithFuel" id="ProductDeliverySumWithFuel_'+k+'" rowid="'+k+'">0</div>';

            k++;


            var markup = "<tr><td align='center'><label class='kt-checkbox kt-checkbox--brand'><input type='checkbox' name='record'><span style='top: 4px;left: 5px;'></span></label></td><td>" + ProductName + "</td><td>"+ProductCatalogName+"</td><td>"+ProductCatalogCode+"</td><td>" + ProductMeasureId + "</td><td>"+ProductCount+"</td><td>"+ProductSumma+"</td><td>"+ ProductFuelRate +"</td><td>"+ProductFuelSum+"</td><td>"+ProductDeliverySum+"</td><td>"+ProductVatRate+"</td><td>"+ProductVatSum+"</td><td>"+ProductDeliverySumWithVat+"</td> </tr>";




            // $(this).closest('table').find('tr:last').prev().after(markup);


            $("table tbody tr:last").before(markup);
            // $("table tbody").find('tr:last').prev().append(markup);

            // e.preventDefault();
        });

        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    var data = document.getElementById("items_json").value;
                    data = JSON.parse(data);
                    var index = $(this).attr("rowid");
                    if (typeof data[index] !== 'undefined') {
                        delete data[index];
                    }

                    $(this).parents("tr").remove();
                }
            });
        });

        var row_id = 0;

        $(document).on("click",".editable",function () {
            console.log("sdfgsdfg");
            row_id = $(this).attr('rowid');
            var name = $(this).attr('name');
            switch (name) {
                case "ProductName":
                    new_item = $('<input class="editable" id="' + $(this).attr('name') + '_' + row_id + '" rowid="' + row_id + '"  name="' + name + '" value="' + $(this).text() + '" >');
                    $(this).replaceWith(new_item);
                    new_item.trigger('focus');
                    break;
                case "ProductMeasureId":
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
                    break;
                case "ProductCatalogCode":
                    new_item = $('<input class="editable" id="' + $(this).attr('name') + '_' + row_id + '" rowid="' + row_id + '"  name="' + name + '" value="' + $(this).text() + '" >');
                    $(this).replaceWith(new_item);
                    new_item.trigger('focus');
                    break;
                case "ProductCatalogName":
                    if(!$(this).is("select")) {
                        $.ajax({
                            url: '/api/get-catalog',
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
                    break;
                default:
                    new_item = $('<input class="editable" id="' + $(this).attr('name') + '_' + row_id + '" onkeyup="CalcStandart(this,' + row_id + ')"  rowid="' + row_id + '"  name="' + name + '" value="' + $(this).text() + '" >');
                    $(this).replaceWith(new_item);
                    new_item.trigger('focus');
                    break;
            }
        });

        $(document).on('focusout',".editable",function (e) {
            var list_data = {};
            // console.log(e.target.name);
            var data = $("#items_json").val();
            data = JSON.parse(data);
             var countAll = 0;
             // var sumProduct = 0;
             var ProductVatSum = 0;
             var ProductDeliverySum = 0;
             var ProductDeliverySumWithVat = 0;
            $.each(data, function(index, value) {
                countAll += (value.ProductCount* 1);
                // sumProduct += (value.ProductSumma * 1);
                ProductDeliverySum += (value.ProductDeliverySum * 1);
                ProductVatSum += (value.ProductVatSum * 1);
                ProductDeliverySumWithVat += (value.ProductDeliverySumWithVat * 1);
                // console.log(value.ProductCount);
            });
            console.log(countAll);
            document.getElementById("ProductCountAll").innerText = countAll;
            // document.getElementById("ProductSummaAll").innerText = sumProduct;
            document.getElementById("ProductDeliverySumAll").innerText = ProductDeliverySum;
            document.getElementById("ProductVatSumAll").innerText = ProductVatSum;
            document.getElementById("ProductDeliverySumWithVatAll").innerText = ProductDeliverySumWithVat;


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
            var formData = new FormData($('#w1')[0]);
            $("#UploadBtn").addClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
            $.ajax({
                url: "/uz/facturas/import-excel",  //Server script to process data
                type: 'POST',
                // Form data
                data: formData,
                datatype:'json',
                success: function(data) {
                    $("#UploadBtn").removeClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
                    console.log(data.fuel);
                    if(data.success==true){
                        // document.getElementById('docs-hasfuel').value = data.fuel;
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
        text-align: right;
    }
    div[name="ProductName"],div[name="ProductCatalogName"],div[name="ProductCatalogCode"] {
        text-align: left;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        width: 100%;
    }

    input[class="editable"] {
        text-align: right;
    }
    input[name="ProductName"] {
        text-align: left;
    }

    table tbody tr td input, select{
        width:100%;
        height:35px;
        padding-left:3px;
        border:0px;
    }

    .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
        border-bottom-width: 2px;
        vertical-align: middle;
    }
</style>