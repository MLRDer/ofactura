<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Empowerment */

$this->title = 'Update Empowerment';
$this->params['breadcrumbs'][] = ['label' => 'Empowerments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name')
?>
<div class="white-box">
    <?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>
    <div class="row m-b-20">
        <div class="col-md-6">
            <div class="page-title m-b-0"><?= $this->title ?> <span class="number">№ <?= $model->EmpowermentNo?></span></div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">

                <?= Html::submitButton(Yii::t('main', 'Empowerment save'), ['class' => 'btn-green']) ?>
            </div>
        </div>
        <div class="col-md-12">
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
        </div>
    </div>
    <div class="row m-b-30">

        <div class="col-md-4">
            <?= $form->field($model, 'EmpowermentNo',['template'=>'<div class="input m-b-20">{input}</div>'])->textInput(['maxlength' => true,'placeholder'=>'Номер доверенности']) ?>

        </div>
        <div class="col-md-4">
            <?php
            echo $form->field($model, 'EmpowermentDateOfIssue',['template'=>'<div class="input m-b-20 datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('main','Enter begin date ...')],
                'type' => DatePicker::TYPE_INPUT,
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
            echo $form->field($model, 'EmpowermentDateOfExpire',['template'=>'<div class="input m-b-20 datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('main','Enter end date ...')],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ContractNo',['template'=>'<div class="input m-b-20">{input}</div>'])->textInput(['maxlength' => true,'placeholder'=>'Номер договора']) ?>
        </div>
        <div class="col-md-8">


            <?php
            echo $form->field($model, 'ContractDate',['template'=>'<div class="input m-b-20 datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('main','Дата подписания договора')],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>

        </div>
    </div>
    <div class="row no-gutters m-b-20">
        <div class="col-md-6">
            <div class="gray-wrapper">
                <div class="supplier-wrapper">
                    <div class="supplier-header">
                        <div class="title">Поставщик</div>
                        <div class="tin"><?= \cabinet\models\Components::CompanyData('tin')?></div>
                    </div>
                    <div class="supplier-body">


                        <?= $form->field($model, 'BuyerName',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>
                                {input}
                            </label>
                        </div>{error}'])->textInput(['maxlength' => true,'class'=>'']) ?>

                        <?= $form->field($model, 'BuyerAddress',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>
                                {input}
                            </label>
                        </div>{error}'])->textInput(['maxlength' => true,'class'=>'']) ?>

                        <?= $form->field($model, 'BuyerAccount',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>
                                {input}
                            </label>
                        </div>{error}'])->textInput(['maxlength' => true,'class'=>'']) ?>

                        <?= $form->field($model, 'BuyerBankId',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>
                                {input}
                            </label>
                        </div>{error}'])->textInput(['maxlength' => true,'class'=>'']) ?>

                        <?= $form->field($model, 'BuyerOked',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>
                                {input}
                            </label>
                        </div>{error}'])->textInput(['maxlength' => true,'class'=>'']) ?>

                        <?= $form->field($model, 'BuyerDistrictId',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>
                                {input}
                            </label>
                        </div>{error}'])->textInput(['maxlength' => true,'class'=>'']) ?>
                    </div>
                </div>
                <div class="attorney-wrapper">
                    <div class="attorney-header">
                        <div class="title">Доверенность</div>
                    </div>
                    <div class="attorney-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!--                                <div class="input m-b-20">-->
                                <!--                                    <input type="text"  placeholder="ИНН сотрудника">-->
                                <!--                                </div>-->
                                <?= $form->field($model, 'AgentTin',['template'=>'<div class="input m-b-20">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'ИНН сотрудника','onkeyup'=>'GetAgentTin(this.value)'])->label(false) ?>
                            </div>
                            <div class="col-md-6">

                                <?= $form->field($model, 'AgentFio',['template'=>'<div class="input m-b-20">{input}<div class="footer-info">Которому выдана доверенность</div></div>{error}'])->textInput(['class'=>'','placeholder'=>'Ф.И.О.'])->label(false) ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'AgentJobTitle',['template'=>'<div class="input m-b-20">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'Должность'])->label(false) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'AgentPassportNumber',['template'=>'<div class="input m-b-20">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'Номер паспорта'])->label(false) ?>
                            </div>
                            <div class="col-md-6">
                                <!--                                <div class="input m-b-20 datepicker-wrapper my-datepicker-icon">-->
                                <!--                                    <input type="text" placeholder="Дата выдачи" class="my-datepicker">-->
                                <!--                                </div>-->

                                <?php
                                echo $form->field($model, 'AgentPassportDateOfIssue',['template'=>'<div class="input m-b-20 datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => Yii::t('main','Дата выдачи')],
                                    'type' => DatePicker::TYPE_INPUT,
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'todayHighlight' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ]);
                                ?>

                            </div>
                            <div class="col-md-12">

                                <?= $form->field($model, 'AgentPassportIssuedBy',['template'=>'<div class="input m-b-20">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'Кем выдан'])->label(false) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="responsible-wrapper">
                    <div class="responsible-header">
                        <div class="title">Ответственные</div>
                    </div>
                    <div class="responsible-body">
                        <?= $form->field($model, 'BuyerDirector',['template'=>'<div class="input ">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'ФИО руководителя'])->label(false) ?>
                        <?= $form->field($model, 'BuyerAccountant',['template'=>'<div class="input ">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'Гл.бухгалтер'])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="customer p-l-30 p-b-30 p-t-30">
                <div class="supplier-wrapper">
                    <div class="supplier-header">
                        <div class="title">Заказчик</div>
                        <div class="input plus-button bgc-gray">
                            <button onclick="GetEnviromentBuyer()" id="SearchEnvBtn" type="button">
                                <img src="/new_template/images/icon/search.svg" alt="">
                            </button>
                            <input onkeyup="GetEnviromentDataByTin(this.value)" id="EnvBuyerTin" type="text" placeholder="Найти">
                        </div>
                    </div>
                    <div class="supplier-body">
                        <div id="SendLevelArea"></div>

                        <?= $form->field($model, 'SellerTin',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>{input}</label></div>{error}'])->hiddenInput(['class'=>''])->label(false) ?>
                        <?= $form->field($model, 'SellerName',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>{input}</label></div>{error}'])->textInput(['class'=>'']) ?>
                        <?= $form->field($model, 'SellerAddress',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>{input}</label></div>{error}'])->textInput(['class'=>'']) ?>
                        <?= $form->field($model, 'SellerAccount',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>{input}</label></div>{error}'])->textInput(['class'=>'']) ?>

                        <?= $form->field($model, 'SellerBankId',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>{input}</label></div>{error}'])->textInput(['class'=>'']) ?>
                        <?= $form->field($model, 'SellerOked',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>{input}</label></div>{error}'])->textInput(['class'=>'']) ?>
                        <?= $form->field($model, 'SellerDistrictId',['template'=>'<div class="second-input">
                            <label><span class="title">{label}</span>{input}</label></div>{error}'])->textInput(['class'=>'']) ?>
                    </div>
                </div>
                <div class="small-table">
                    <div class="body m-b-20">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="40px"></th>
                                <th ><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
                                <th width="130px" ><?= Yii::t('main','Ед. изм.')?></th>
                                <th width="90px"><?= Yii::t('main','Кол - во')?></th>
                            </tr>
                            </thead>
                            <tbody id="productItemsArea">
                            <?php if($model->isNewRecord){ ?>
                                <tr>
                                    <td align="center">
                                        <label class="second-checkbox d-inline-block m-t-5">
                                            <input type="checkbox" name="record">
                                            <div class="square"></div>
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
                                $products = \common\models\EmpowermentProduct::findAll(['empowerment_id'=>$model->id]);
                                $n=0;
                                foreach ($products as $items){ $n++;
                                    ?>
                                    <tr>
                                        <td align="center">
                                            <label class="second-checkbox d-inline-block m-t-5">
                                                <input type="checkbox" name="record">
                                                <div class="square"></div>
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
                    </div>
                    <div class="footer">
                        <div class="add-row btn-outline-blue color-blue small-btn m-r-20">+ добавить еще</div>
                        <div class="delete-row btn-red remove">remove</div>
                    </div>
                </div>
                <div class="responsible-wrapper">
                    <div class="responsible-header">
                        <div class="title">Ответственные</div>
                    </div>
                    <div class="responsible-body">

                        <?= $form->field($model, 'SellerDirector',['template'=>'<div class="input ">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'ФИО руководителя'])->label(false) ?>
                        <?= $form->field($model, 'SellerAccountant',['template'=>'<div class="input ">{input}</div>{error}'])->textInput(['class'=>'','placeholder'=>'Гл.бухгалтер'])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('main', 'Empowerment save'), ['class' => 'btn-green']) ?>
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
            var ProductCount =  '<div class="editable" name="ProductCount" id="ProductCount_'+k+'" rowid="'+k+'"></div>';
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
