<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-21
 * Time: 14:53
 */

use cabinet\classes\consts\ExcelConst;
$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name')
?>






    <table class="table table-bordered">
    <thead>

    <tr id="productItemsAreaHead">
        <th rowspan="2"></th>

        <th rowspan="2"><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
        <th rowspan="2"><?= Yii::t('main','Product Code')?></th>
        <th rowspan="2"><?= Yii::t('main','Ед. изм.')?></th>
        <th rowspan="2"><?= Yii::t('main','Кол - во')?></th>
        <th rowspan="2"><?= Yii::t('main','Цена за единицу')?></th>


        <th colspan="2" rowspan="1"><?= Yii::t('main','AKSIS')?></th>
        <th rowspan="2"><?= Yii::t('main','Стоимость поставки')?></th>
        <th colspan="2" rowspan="1"><?= Yii::t('main','НДС')?></th>
        <th rowspan="2"><?= Yii::t('main','Стоимость поставок с учётом НДС')?></th>


    </tr>
    <tr>
        <th rowspan="1"><?= Yii::t('main','ставка %')?></th>
        <th rowspan="1"><?= Yii::t('main','сумма')?></th>

        <th rowspan="1"><?= Yii::t('main','ставка %')?></th>
        <th rowspan="1"><?= Yii::t('main','сумма')?></th>
    </tr>

    </thead>
    <tbody id="productItemsArea">







<?php
$i=0;
$ord = 1;
$productCountAll = 0;
$productPriceAll = 0;
$productVarpercernt = 0;
$productVatRate = 0;
$productVatValue = 0;
$productDelivery = 0;

foreach ($data as $items){
    $i++;

    if($i <= ExcelConst::ROW_BEGIN_KEY){
        $ord = 1;
        continue;

    }
    $productCountAll += $items[ExcelConst::KEY_COUNT];
    $productPriceAll += $items[ExcelConst::KEY_PRICE];
    $productVarpercernt += $items[ExcelConst::KEY_DELIVER_SUM];
    $productVatRate += $items[ExcelConst::KEY_VAT_RATE];
    $productVatValue += $items[ExcelConst::KEY_VAT_VALUE];
    $productDelivery += $items[ExcelConst::KEY_DELIVER_WITH_RATE];

    ?>
<tr>
    <td align="center">

        <label class="kt-checkbox kt-checkbox--brand">
            <input type="checkbox" name="record">
            <span style="top: 4px;left: 5px;"></span>
        </label>

    </td>

    <td>
        <div class="editable" name="ProductName" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_NAME]?></div>
    </td>
    <td>
        <div class="editable" name="CatalogCode" rowid="<?= $ord ?>"><?= $items[ExcelConst::CATALOG_CODE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductMeasureId" rowid="<?= $ord ?>"><?= $measure[$items[ExcelConst::KEY_CODE]] ?></div>
    </td> 
    <td>
        <div class="editable" name="ProductCount" id="ProductCount_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_COUNT]?></div>
    </td>
    <td>
        <div class="editable" name="ProductSumma" id="ProductSumma_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_PRICE]?></div>
    </td>

    <td>
        <div class="editable" name="ProductFuelRate" id="ProductFuelRate_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_FUEL_RATE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductFuelSum" id="ProductFuelSum_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_FUEL_VALUE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductDeliverySum" id="ProductFuelSum_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_DELIVER_SUM]?></div>
    </td>
    <td>
        <div class="editable" name="ProductVatRate" id="ProductVatRate_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_VAT_RATE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductVatSum" id="ProductVatSum_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_VAT_VALUE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductDeliverySumWithVat" id="ProductDeliverySum_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ExcelConst::KEY_DELIVER_WITH_RATE]?></div>
    </td>



</tr>
<?php $ord ++; }?>
<tr rowid="1">
    <td align="right" colspan="4">
        <div style="padding-right:10px">
            <b><?= Yii::t('main','Jami:')?></b>
        </div>
    </td>
    <td>
        <div  name="ProductCount" id="ProductCountAll"><?= $productCountAll ?></div>
    </td>
    <td>
        <div  name="ProductSumAll" id="ProductSumAll"><?= $productPriceAll ?></div>
    </td>
    <td>

    </td>
    <td>


    </td>
    <td>

    </td>
    <td>


    </td>
    <td>

        <div  name="ProductVatSum" id="ProductVatSumAll"><?=$productVatValue?></div>
    </td>

    <td>
        <div name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVatAll"><?=$productDelivery ?></div>
    </td>


</tr>
    </tbody>
    </table>
