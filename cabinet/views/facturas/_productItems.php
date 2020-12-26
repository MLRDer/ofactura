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
        <th  rowspan="2"></th>

        <th rowspan="2"><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
        <th rowspan="2"><?= Yii::t('main','Product Code')?></th>
        <th rowspan="2"><?= Yii::t('main','Ед. изм.')?></th>
        <th rowspan="2"><?= Yii::t('main','Кол - во')?></th>
        <th rowspan="2"><?= Yii::t('main','Цена за единицу')?></th>
        <th rowspan="2"><?= Yii::t('main','Стоимость поставки')?></th>
        <th colspan="2" rowspan="1"><?= Yii::t('main','НДС')?></th>
        <th rowspan="2"><?= Yii::t('main','Стоимость поставок с учётом НДС')?></th>
    </tr>
    <tr>
        <th rowspan="1"><?= Yii::t('main','ставка %')?></th>
        <th rowspan="1"><?= Yii::t('main','сумма')?></th>


    </tr>

    </thead>
    <tbody id="productItemsArea">

<?php
$i=0;
$ord = 1;

foreach ($data as $items){
    $i++;

    if($i <= ExcelConst::ROW_BEGIN_KEY){
        $ord = 1;
        continue;

    }

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
    <td align="right" colspan="5">
        <div style="padding-right:10px">
            <b><?= Yii::t('main','Jami:')?></b>
        </div>
    </td>
    <td>
        <div  name="ProductCount" id="ProductCountAll"> </div>
    </td>
    <td>

    </td>
    <td>
        <div  name="ProductDeliverySum" id="ProductDeliverySumAll"> </div>
    </td>
    <td>


    </td>
    <td>


    </td>
    <td>


    </td>
    <td>

        <div  name="ProductVatSum" id="ProductVatSumAll"> </div>
    </td>

    <td>
        <div name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVatAll"> </div>
    </td>


</tr>
    </tbody>
    </table>
