<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ReestrMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reestr-main-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">

        <div class="col-md-6">
            <div class="input m-b-30">
            <?= $form->field($model, 'reest_no')->textInput(['maxlength' => true,'class'=>'']) ?>
            </div>
        </div>
        <div class="col-md-6">
             
            <?php
            echo $form->field($model, 'reestr_date',['template'=>'{label}<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [

                'options' => ['placeholder' => Yii::t('main','Enter date ...'),'value'=>date('Y-m-d'),'class'=>'my-datepicker'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
            <?= $form->field($model, 'json_data')->hiddenInput()->label(false) ?>
        </div>

    <div class="col-md-12 table-card-gray" id="gridArea">
        <div class="header">
        <label class="btn-blue font-weight-normal text-transform-none m-r-20 " id="UploadBtn">
            <i class="flaticon-attachment"></i> <?= Yii::t('main','Exel to import btn')?>
            <input type="file" id="docs-reestr" name="ReestrMain[file]" hidden>
        </label>
        <div class="btn-white">
            <a href="/docs/reestr шаблон.xlsx"> <?= Yii::t('main','Skachat reestr')?></a>
        </div>
        </div>
        <div class="items-grid-template">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="40px" rowspan="2">П.Н.</th>
                <th width="70px" rowspan="2">ИНН Контрагентов</th>
                <th width="50px" rowspan="2">№ счет-фактуры</th>
                <th width="50px" rowspan="2">дата счет-фактуры</th>
                <th width="70px" rowspan="2">№ договора</th>
                <th width="70px" rowspan="2">дата договора</th>

                <th rowspan="2"><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
                <th width="60px" rowspan="2"><?= Yii::t('main','Ед. изм.')?></th>
                <th width="90px" rowspan="2"><?= Yii::t('main','Кол - во')?></th>
                <th width="90px" rowspan="2"><?= Yii::t('main','Цена за единицу')?></th>
                <th width="90px" rowspan="2"><?= Yii::t('main','Стоимость поставки')?></th>
                <th width="60px" colspan="2" rowspan="1"><?= Yii::t('main','НДС')?></th>
                <th width="90px" rowspan="2"><?= Yii::t('main','Стоимость поставок с учётом НДС')?></th>
                <th width="60px" colspan="2" rowspan="1"><?= Yii::t('main','AKSIS')?></th>
                <th width="90px" rowspan="2"><?= Yii::t('main','Стоимость поставок с учётом AKSIS')?></th>
            </tr>
            <tr>
                <th width="80px" rowspan="1"><?= Yii::t('main','ставка %')?></th>
                <th width="80px" rowspan="1"><?= Yii::t('main','сумма')?></th>

                <th width="80px"   rowspan="1"><?= Yii::t('main','ставка %')?></th>
                <th width="80px"   rowspan="1"><?= Yii::t('main','сумма')?></th>
            </tr>

            </thead>
            <tbody id="productItemsArea">
            <tr>
                <td align="center">

                </td>
                <td>
                    <div  name="INN" rowid="1"></div>
                </td>
                <td>
                    <div name="FacNum" rowid="1"></div>
                </td>
                <td>
                    <div name="FacDate" rowid="1"></div>
                </td>
                <td>
                    <div name="ContNo" rowid="1"></div>
                </td>
                <td>
                    <div name="ConDate" rowid="1"></div>
                </td>
                <td>
                    <div   name="ProductName" rowid="1"></div>
                </td>
                <td>
                    <div  name="ProductMeasureId" rowid="1"></div>
                </td>
                <td>
                    <div   name="ProductCount" id="ProductCount_1" rowid="1">0</div>
                </td>
                <td>
                    <div   name="ProductSumma" id="ProductSumma_1" rowid="1">0</div>
                </td>
                <td>
                    <div   name="ProductDeliverySum" id="ProductDeliverySum_1" rowid="1">0</div>
                </td>

                <td>
                    <div   name="ProductVatRate" id="ProductVatRate_1" rowid="1">0</div>
                </td>
                <td>
                    <div   name="ProductVatSum" id="ProductVatSum_1" rowid="1">0</div>
                </td>

                <td>
                    <div   name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVat_1" rowid="1">0</div>
                </td>

                <td  >
                    <div   name="ProductFuelRate" id="ProductFuelRate_1" rowid="1">0</div>
                </td>
                <td  >
                    <div  name="ProductFuelSum" id="ProductFuelSum_1" rowid="1">0</div>
                </td>
                <td >
                    <div   name="ProductDeliverySumWithFuel" id="ProductDeliverySumWithFuel_1" rowid="1">0</div>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
