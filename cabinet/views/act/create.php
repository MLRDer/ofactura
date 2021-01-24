<?php

use kartik\date\DatePicker;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Acts */

$this->title = Yii::t('main', 'Create Acts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Acts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>

<div class="white-box">
    <div class="row m-b-20">
        <?= \common\widgets\Alert::widget() ?>
        <div class="col-md-6">
            <div class="page-title m-b-0" id="title-create"><?= $this->title ?></div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="input m-b-30">
                <?= $form->field($model, 'ActNo',['template'=>'{input}{error}<a  href="/format-num/create" target="_blank" class="border-link">'.Yii::t('main','Настройка нумерация').' </a>'])->textInput(['maxlength' => true,'class'=>'','placeholder'=>Yii::t('main','ActNo')])->label(false) ?>

            </div>

        </div>
        <div class="col-md-3">
            <div class="input m-b-30">

                <?php echo $form->field($model, 'ActDate',['template'=>'<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter act date ...'),'class'=>'my-datepicker'],
//                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])->label(false);?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input m-b-30">
                <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true,'class'=>'','placeholder'=>Yii::t('main','ContractNo')])->label(false) ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input m-b-30">

                <?php echo $form->field($model, 'ContractDate',['template'=>'<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter contract date ...'),'class'=>'my-datepicker'],
//                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])->label(false);?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="gray-wrapper">
                <div class="attorney-wrapper">
                    <div class="attorney-header">
                        <div class="title"><?= Yii::t('main','Мазмуни')?></div>
                    </div>
                    <div class="input m-b-30">
                        <?= $form->field($model, 'SellerTin')->hiddenInput(['maxlength' => true,'class'=>'','placeholder'=>Yii::t('main','BuyerName')])->label(false) ?>
                        <?= $form->field($model, 'SellerName')->hiddenInput(['maxlength' => true,'class'=>'','placeholder'=>Yii::t('main','BuyerName')])->label(false) ?>
                        <?= $form->field($model, 'ActText')->textarea(['maxlength' => true,'rows'=>8])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">

                        <?= $form->field($model, 'BuyerTin',['template'=>'<div class="input plus-button bgc-gray">
                            <button onclick="GetActBuyer()" id="SearchEnvBtn" type="button">
                                <img src="/new_template/images/icon/search.svg" alt="">
                            </button>
                            
                            {input}                           
                        </div>{error}'])->textInput(['maxlength' => true,'class'=>'','placeholder'=>Yii::t('main','Найти'),'onkeyup'=>'GetBuyerTinAct(this.value)'])->label(false) ?>

                </div>
                <div class="col-md-8">
                    <div class="input m-b-30">
                        <?= $form->field($model, 'BuyerName')->textInput(['maxlength' => true,'class'=>'','placeholder'=>Yii::t('main','BuyerName')])->label(false) ?>

                    </div>
                </div>
                <div class="col-md-12" id="alertArea">

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div id="gridArea" class="items-grid-template p-t-30">
                <?= $this->render("/api-v2/_gridAct",['model'=>$model])?>
                <?php if($model->isNewRecord || $model->json_items==""){ ?>

                    <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json",'value'=>"{}"])->label(false) ?>

                <?php } else {?>

                    <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json"])->label(false) ?>

                <?php }?>
            </div>
        </div>
        <div class="col-md-12">

            <div class="d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>

<script>
    $(document).ready(function(){
        var k=document.getElementById('row_value').value;
        $(".add-row").click(function(){

            var ProductName =  '<div class="editable" name="ProductName" id="ProductName_'+k+'" rowid="'+k+'"></div>';
            var ProductCount =  '<div class="editable" name="ProductCount" id="ProductCount_'+k+'" rowid="'+k+'"></div>';
            var ProductMeasureId =  '<div class="editable" name="ProductMeasureId" id="ProductMeasureId_'+k+'" rowid="'+k+'"></div>';

            var ProductSumma =  '<div class="editable" name="ProductSumma" id="ProductSumma_'+k+'" rowid="'+k+'"></div>';
            var ProductDeliverySum =  '<div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_'+k+'" rowid="'+k+'"></div>';


            k++;


            var markup = "<tr><td align='center'><label class='second-checkbox d-inline-block m-t-5'><input type='checkbox' name='record'><div class='square'></div></label></td><td>" + ProductName + "</td> <td>" + ProductMeasureId + "</td><td>"+ProductCount+"</td><td>"+ProductSumma+"</td><td>"+ProductDeliverySum+"</td></tr>";




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
            $.each(data, function(index, value) {
                countAll += (value.ProductCount* 1);
                // sumProduct += (value.ProductSumma * 1);
                ProductDeliverySum += (value.ProductDeliverySum * 1);
                ProductVatSum += (value.ProductVatSum * 1);

                // console.log(value.ProductCount);
            });

            // document.getElementById("ProductCountAll").innerText = countAll;
            // // document.getElementById("ProductSummaAll").innerText = sumProduct;
            // document.getElementById("ProductDeliverySumAll").innerText = ProductDeliverySum;
            // document.getElementById("ProductVatSumAll").innerText = ProductVatSum;
            // document.getElementById("ProductDeliverySumWithVatAll").innerText = ProductDeliverySumWithVat;


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

<style>
    .invalid-feedback {
        display: block;

    }
    .spinner-border {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        vertical-align: text-bottom;
        border: 0.25em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: spinner-border .75s linear infinite;
        animation: spinner-border .75s linear infinite;
    }
</style>