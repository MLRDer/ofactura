<?php

use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Facturas */

$this->title = Yii::t('main', 'Create Docs');
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$tab = Yii::$app->request->get('tab',"w1-tab0");
$type_factura = substr($tab,6,1);
?>

<?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>
<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-6">
            <div class="page-title m-b-0" id="title-create">Счет-фактуры</div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <label class="invoice-checkbox m-r-30">
                    <div class="title">Односторонняя "фактура"</div>
                    <input type="checkbox" onclick="SwitchSingleSlide(5)" id="CheckOnLevel">
                    <div class="switch-checkbox"></div>
                </label>

                <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php

            echo $form->field($model, 'FacturaType')->hiddenInput(['value'=>$type_factura])->label(false);

            echo Tabs::widget([
                'options'=>['class'=>'profile-tab-header'],
                'itemOptions'=>['class'=>'tab-pane fade show'],
                'headerOptions'=>['class'=>''],
                'items' => [
                    [
                        'label' => 'Стандартная',
                        'content' => '',
                        'active' => ($tab=="w1-tab0")?true:false
                    ],
                    [
                        'label' => 'Дополнительная',
                        'content' => $this->render('_extra',['form'=>$form,'model'=>$model]),
                        'active' => ($tab=="w1-tab1")?true:false
                    ],
                    [
                        'label' => 'Возмещение расходов',
                        'content' => $this->render('_repayment'),
                        'active' => ($tab=="w1-tab2")?true:false

                    ],
                    [
                        'label' => 'Без оплаты',
                        'content' => $this->render('_nopayment'),
                        'active' => ($tab=="w1-tab3")?true:false

                    ],
                    [
                        'label' => 'Исправленная',
                        'content' => $this->render('_corrected',['form'=>$form,'model'=>$model]),
                        'active' => ($tab=="w1-tab4")?true:false

                    ],

                ],
            ]);
            ?>
        </div>
        <div class="col-md-12">
            <div class="row m-b-50">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="second-input">
                                <?= $form->field($model, 'SellerName',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="second-input">
                                <?= $form->field($model, 'SellerAccount',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="second-input">
                                <?= $form->field($model, 'SellerBankId',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="second-input">
                                <?= $form->field($model, 'SellerAddress',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="second-input">
                                <?= $form->field($model, 'SellerOked',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="second-input">
                                <?= $form->field($model, 'SellerVatRegCode',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-block-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="second-input">
                                    <div class="btn-change-info" onclick="ChangeStirData()">
                                        <img src="/new_template/images/icon/edit.svg" alt="">
                                        <div class="title">Изменить</div>
                                    </div>
                                    <?= $form->field($model, 'BuyerName',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="second-input">
                                    <?= $form->field($model, 'BuyerAddress',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="second-input">
                                    <?= $form->field($model, 'BuyerAccount',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="second-input">
                                    <?= $form->field($model, 'BuyerBankId',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="second-input">
                                    <?= $form->field($model, 'BuyerOked',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="second-input">
                                    <?= $form->field($model, 'BuyerVatRegCode',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <?= $form->field($model, 'BuyerDistrictId')->hiddenInput(['class'=>'form-control-plaintext input-sm'])->label(false) ?>

                                <?= $form->field($model, 'BuyerDirector')->hiddenInput(['maxlength' => true])->label(false) ?>

                                <?= $form->field($model, 'BuyerAccountant')->hiddenInput(['maxlength' => true])->label(false) ?>

                                <?= $form->field($model, 'BuyerVatRegCode')->hiddenInput(['maxlength' => true,'class'=>'form-control-plaintext input-sm'])->label(false) ?>

                            </div>

                        </div>
                    </div>
                    <div class="change-info-block-wrapper show-block">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input m-b-30">
                                    <?= $form->field($model, 'FacturaNo')->textInput(['maxlength' => true,'placeholder'=>'Номер счета-фактуры','class'=>''])->label(false) ?>
                                </div>
                            </div>
                            <div class="col-md-6">

                                    <?php
                                    echo $form->field($model, 'FacturaDate',['template'=>'<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                                        'options' => ['placeholder' => Yii::t('main','Enter factura date ...'),'class'=>'my-datepicker'],
//                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ])->label(false);
                                    ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="gray-card">
                                    <div class="header">
                                        <div class="title">Дополнительно</div>
                                    </div>
                                    <div class="body">
                                        <div class="row">
                                            <div class="col-md-6">

                                                    <?= $form->field($model, 'ContractNo',['template'=>'<div class="input-white">{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder'=>'Номер договора','class'=>''])->label(false) ?>

                                            </div>
                                            <div class="col-md-6">

                                                    <?php
                                                    echo $form->field($model, 'ContractDate',['template'=>'<div class="input-white datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => Yii::t('main','Enter contract date ...'),'class'=>'my-datepicker'],
//                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                        'type' => DatePicker::TYPE_INPUT,
                                                        'pluginOptions' => [
                                                            'autoclose'=>true,
                                                            'todayHighlight' => true,
                                                            'format' => 'yyyy-mm-dd'
                                                        ]
                                                    ])->label(false);
                                                    ?>


<!--                                                    <input type="text" placeholder="Дата договора" class="my-datepicker">-->

                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-white">
                                                    <input type="text" onkeyup="GetDataByTinV2(this.value)" placeholder="<?= Yii::t('main','Введите инн...')?>" id="BuyerTin">
                                                    <?= $form->field($model, 'BuyerTin')->hiddenInput()->label(false) ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="BuyerInfoArea">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="singid-side-block">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input">
<!--                                    16022-->
                                <?= $form->field($model, 'SingleSidedType')->dropDownList(['0'=>'Выбрате',   '1'=>'На физ. лицо','2'=>'На экспорт','3'=>'На импорт','4'=>'Реализация, связанная с гос. секретом','5'=>'Финансовые услуги']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-b-50">
        <div class="col-md-12">
            <div class="table-card-gray">
                <div class="header">

                    <label class="btn-blue font-weight-normal text-transform-none m-r-20" id="UploadBtn">
                        <img src="/new_template/images/icon/clip.svg" alt=""> <?= Yii::t('main','Exel to import btn')?>
                        <input type="file" id="docs-file" name="Facturas[file]" hidden>
                    </label>
                    <div class="btn-white"><a href="/docs/faktura_all_template.xlsx">Скачать шаблон</a></div>
                </div>
                <div class="body m-b-20">
                    <div id="gridArea">
                        <?= $this->render("/api-v2/_gridWithFuel",['model'=>$model])?>
                    </div>
                    <?php if($model->isNewRecord || $model->json_items==""){ ?>

                        <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json",'value'=>"{}"])->label(false) ?>

                    <?php } else {?>

                        <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json"])->label(false) ?>

                    <?php }?>
                </div>
<!--                <div class="footer">-->
<!--                    <div class="btn-outline-blue color-blue standard-btn m-r-20">+ добавить еще</div>-->
<!--                    <div class="btn-red remove">remove</div>-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 m-b-30">
            <?= $form->field($model, 'SellerDirector',['template'=>'{label}<div class="input">{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder'=>'ФИО директора']) ?>
        </div>
        <div class="col-md-4 m-b-30">
            <?= $form->field($model, 'SellerAccountant',['template'=>'{label}<div class="input">{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder'=>'ФИО главного бухгалтера']) ?>
        </div>
        <div class="col-md-4 m-b-30">
            <?= $form->field($model, 'ItemReleasedFio',['template'=>'{label}<div class="input">{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder'=>'ФИО лица, отпустившего товары']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 m-b-30">
            <div class="d-flex justify-content-start align-items-center">
                <label class="invoice-checkbox m-r-30 show-extra-form-btn">
                    <div class="title">Доверенность</div>
                    <input type="checkbox">
                    <div class="switch-checkbox"></div>
                </label>
                <div class="line-gray"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row extra-form">
                <div class="col-md-2 m-b-30">


                    <?= $form->field($model, 'EmpowermentNo',['template'=>'{label}<div class="input">{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder'=>'№ доверенности'])->label(false) ?>
                </div>
                <div class="col-md-2 m-b-30">
                    <?php
                    echo $form->field($model, 'EmpowermentDateOfIssue',['template'=>'<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => Yii::t('main','Enter date ...'),'class'=>'my-datepicker','value'=>date('Y-m-d')],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-4 m-b-30">
                    <?= $form->field($model, 'AgentFio',['template'=>'{label}<div class="input">{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder'=>'ФИО доверенного лица'])->label(false) ?>
                </div>
                <div class="col-md-4 m-b-30">
                    <?= $form->field($model, 'AgentTin',['template'=>'{label}<div class="input">{input}</div>{error}'])->textInput(['maxlength' => true,'placeholder'=>'ИНН доверенного лица'])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
            </div>
        </div>
    </div>
</div>

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


            var markup = "<tr><td align='center'><label class='second-checkbox d-inline-block m-t-5'><input type='checkbox' name='record'><div class='square'></div></label></td><td>" + ProductName + "</td><td>"+ProductCatalogName+"</td><td>"+ProductCatalogCode+"</td><td>" + ProductMeasureId + "</td><td>"+ProductCount+"</td><td>"+ProductSumma+"</td><td>"+ ProductFuelRate +"</td><td>"+ProductFuelSum+"</td><td>"+ProductDeliverySum+"</td><td>"+ProductVatRate+"</td><td>"+ProductVatSum+"</td><td>"+ProductDeliverySumWithVat+"</td> </tr>";




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
            row_id = $(this).attr('rowid');

            var element_td = $(this).closest('tr');
            element_td.addClass('activ_row');


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
            var element_td = $(this).closest('tr');
            element_td.removeClass('activ_row');
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
            var formData = new FormData($('#w0')[0]);
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

<?php ActiveForm::end(); ?>

<style>

</style>
