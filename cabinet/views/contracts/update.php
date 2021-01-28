<?php

use common\widgets\Alert;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contracts */
/* @var $modelsClients common\models\ContractClients */
/* @var $modelsParts common\models\ContractParts */

$this->title = Yii::t('main', 'Create Contracts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
     
   jQuery(".dynamicform_wrapper .main-title").each(function(index) {
        jQuery(this).html("МИЖОЗ: " + (index + 1));
        
    });
    
    jQuery(".dynamicform_wrapper .supplier-body").each(function(index) {
        jQuery(this).attr("client-id",uuidv4());
    });
    
    jQuery(".dynamicform_wrapper .supplier-body .FizTin input").each(function(index) {
        jQuery(this).attr("area-id",index+4);
    });
    jQuery(".dynamicform_wrapper .supplier-body .Tin input").each(function(index) {
        jQuery(this).attr("area-id",index+4);
    });
});

jQuery(".dynamicform_parts").on("afterInsert", function(e, item) {
   jQuery(".dynamicform_parts .part-num").each(function(index) {
        jQuery(this).html((index + 1));
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
   jQuery(".dynamicform_wrapper .main-title").each(function(index) {
        jQuery(this).html("МИЖОЗ: " + (index + 1));        
    });
}); 
 
jQuery(".dynamicform_parts").on("afterDelete", function(e) {
   jQuery(".dynamicform_parts .part-num").each(function(index) {
        jQuery(this).html((index + 1));        
    });
});

';

$this->registerJs($js);
?>


<?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>
<div class="white-box">
    <div class="row m-b-20">
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
        <div class="col-md-12">
            <?= Alert::widget() ?>
        </div>
        <div class="col-md-4">
            <div class="input m-b-30">
                <?= $form->field($model, 'ContractName')->textInput(['maxlength' => true,'class'=>'','placeholder'=>'ContractName'])->label(false) ?>
            </div>
        </div>
        <div class="col-md-4">

            <div class="input m-b-30">
                <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true,'class'=>'','placeholder'=>'ContractNo'])->label(false) ?>
            </div>
        </div>
        <div class="col-md-4">

            <div class="input m-b-30">
                <?= $form->field($model, 'ContractPlace')->textInput(['maxlength' => true,'class'=>'','placeholder'=>'ContractPlace'])->label(false) ?>
            </div>


        </div>
        <div class="col-md-6">

            <div class="input m-b-30">

                <?php echo $form->field($model, 'ContractDate',['template'=>'<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter ContractDate ...'),'class'=>'my-datepicker'],
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

            <div class="input m-b-30">

                <?php echo $form->field($model, 'ContractExpireDate',['template'=>'<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('main','Enter ContractExpireDate ...'),'class'=>'my-datepicker'],
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
        <div class="col-md-12">

            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.dynamic_area', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 999, // the maximum times, an element can be cloned (default 999)
//                'min' => 10, // 0 or 1 (default 1)
                'insertButton' => '.AddClient', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsClients[0],
                'formId' => 'w0',
                'formFields' => [
                    'FizTin',
                    'Fio',
                    'Tin',
                    'Name',
                    'Address',
                    'Oked',
                    'WorkPhone',
                    'Mobile',
                    'Fax',
                    'Account',
                    'BankId',
                    'BranchCode',
                    'BranchName',
                ],
            ]); ?>
            <div class="row m-b-10 dynamic_area">
                <div class="col-md-6">
                    <div class="gray-wrapper">
                        <div class="supplier-wrapper">
                            <div class="supplier-header">
                                <div class="title"><?= Yii::t('main','Ижрочи')?></div>
                                <div class="tin"><?= $model->Tin?> </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="second-input">
                                        <?= $form->field($model, 'FizTin',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Fio',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Tin',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Name',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Address',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Oked',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="second-input">
                                        <?= $form->field($model, 'WorkPhone',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Mobile',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Fax',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="second-input">
                                        <?= $form->field($model, 'Account',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="second-input">
                                        <?= $form->field($model, 'BankId',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="second-input">
                                        <?= $form->field($model, 'BranchCode',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="second-input">
                                        <?= $form->field($model, 'BranchName',['template'=>'<label><span class="title">{label}</span>{input}</label>'])->textInput(['class'=>'']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($modelsClients as $index => $modelClients): ?>
                    <div class="col-md-6 item">
                        <div class="customer">
                            <div class="supplier-wrapper white-box-min">
                                <div class="supplier-header">
                                    <div class="title main-title"><?= Yii::t('main','Мижоз')?></div>
                                    <div>
                                        <div type="button" class="pull-right remove-item close">
                                            <img src="/new_template/images/icon/close.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="supplier-body" client-id="fdd5de54-cfa2-457c-9b86-dade1da99f17">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="second-input FizTin">
                                                <?= $form->field($modelClients, "[{$index}]FizTin",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'','area-id'=>"{$index}"]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]Fio",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="second-input Tin">
                                                <?= $form->field($modelClients, "[{$index}]Tin",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'','area-id'=>"{$index}"]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]Name",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]Address",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]Oked",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]WorkPhone",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]Mobile",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]Fax",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]Account",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]BankId",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->textInput(['class'=>'']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="second-input">
                                                <?= $form->field($modelClients, "[{$index}]BranchCode",['template'=>'<label><span class="title">{label}</span>{input}{error}</label>'])->dropdownList([],['class'=>'','onchange'=>'SelectFilial(this)']) ?>
                                            </div>
                                        </div>

                                        <?= $form->field($modelClients, "[{$index}]BranchName",['template'=>'<label><span class="title">{label}</span>{input}</label>'])->hiddenInput(['class'=>''])->label(false) ?>

                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="col-md-12">
                <div type="button" id="AddClient" class="pull-right AddClient">
                    <?= Yii::t('main','+ Mijoz qoshish')?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
            <div class="col-md-12 p-t-30">
                <div id="gridArea" class="items-grid-template">
                    <?= $this->render("/api-v2/_gridContract",['model'=>$model])?>
                </div>
                <?php if($model->isNewRecord || $model->json_items==""){ ?>
                    <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json",'value'=>"{}"])->label(false) ?>
                <?php } else {?>
                    <?= $form->field($model, 'json_items')->hiddenInput(['id' => "items_json"])->label(false) ?>
                <?php }?>
            </div>

            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_parts', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.parts-body', // required: css class selector
                'widgetItem' => '.item-parts', // required: css class
                'limit' => 999, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.AddParts', // css class
                'deleteButton' => '.CloseParts', // css class
                'model' => $modelsParts[0],
                'formId' => 'w0',
                'formFields' => [
                    'Title',
                    'Body',

                ],
            ]); ?>
            <div class="parts-body">
                <?php foreach ($modelsParts as $index2 => $modelParts): ?>

                    <div class="col-md-12 m-t-30 item-parts">
                        <div class="part-area-title">
                            <div class="input-group">
                                <?= $form->field($modelParts, "[{$index2}]Title",['template'=>'<div class="input-group-prepend">
 <span class="part-num">'.($index2+1).'.</span>
  {input}  <button class="CloseParts" type="button"><img src="/new_template/images/icon/close_white.svg" alt=""></button>
  </div>{error}'])->textInput(['maxlength' => true,'class'=>'part-title','placeholder'=>Yii::t('main','Maydon nomini kiriting')])->label(false) ?>
                            </div>
                        </div>
                        <div class="textarea-part m-b-30">
                            <?= $form->field($modelParts, "[{$index2}]Body")->textarea(['maxlength' => true,'class'=>'','placeholder'=>'Maydon matni','rows'=>6])->label(false) ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="col-md-12">
                <div type="button" id="AddParts" class="pull-right AddParts">
                    + Maydon qo`shish                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
            <div class="col-md-12 m-t-30">

                <div class="d-flex justify-content-end">
                    <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>



<script>
    $(document).ready(function(){
        var k=document.getElementById('row_value').value;
        $(".add-row").click(function(){

            var ProductName =  '<div class="editable" name="ProductName" id="ProductName_'+k+'" rowid="'+k+'"></div>';
            var ProductCount =  '<div class="editable" name="ProductCount" id="ProductCount_'+k+'" rowid="'+k+'"></div>';
            var ProductMeasureId =  '<div class="editable" name="ProductMeasureId" id="ProductMeasureId_'+k+'" rowid="'+k+'"></div>';
            var ProductCatalogName =  '<div class="editable" name="ProductCatalogName" id="ProductCatalogName_'+k+'" rowid="'+k+'"></div>';
            var ProductCatalogCode =  '<div class="editable" name="ProductCatalogCode" id="ProductCatalogCode_'+k+'" rowid="'+k+'"></div>';
            var ProductSumma =  '<div class="editable" name="ProductSumma" id="ProductSumma_'+k+'" rowid="'+k+'"></div>';
            var ProductDeliverySum =  '<div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_'+k+'" rowid="'+k+'"></div>';
            k++;


            var markup = "<tr><td align='center'><label class='second-checkbox d-inline-block m-t-5'><input type='checkbox' name='record'><div class='square'></div></label></td><td>" + ProductName + "</td><td>"+ProductCatalogName+"</td><td>"+ProductCatalogCode+"</td><td>" + ProductMeasureId + "</td><td>"+ProductCount+"</td><td>"+ProductSumma+"</td><td>"+ProductDeliverySum+"</td></tr>";




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
    .profile-tab-header .nav-item .nav-link{
        min-width: 180px !important;
    }

    @media screen and (max-width: 1025px)  {
        .profile-tab-header .nav-item .nav-link{
            min-width: 180px !important;
        }
    }

    @media screen and (max-width: 1260px)  {
        .profile-tab-header .nav-item .nav-link{
            min-width: 200px !important;
        }
    }

    @media screen and (max-width: 769px)  {
        .profile-tab-header .nav-item .nav-link{
            min-width: 150px !important;
        }
    }

    .input-white select{
        border-radius: 10px;
        height: 45px;
        padding: 10px 20px;
    }
    }

</style>


