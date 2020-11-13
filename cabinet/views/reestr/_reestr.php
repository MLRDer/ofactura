<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-21
 * Time: 14:53
 */

use cabinet\classes\consts\ExcelConst;
use cabinet\classes\consts\ReestrConst;

$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name')
?>



<?php
$i=0;
$ord = 0;
//var_dump($data);die;
foreach ($data as $items){
    $i++;

    if($i <= ReestrConst::ROW_BEGIN_KEY){
        $ord = 0;
        continue;

    }
    if($items[ReestrConst::KEY_TIN]==""){
        continue;
    }
    ?>
<tr>
    <td align="center">

        <div  name="INN" rowid="1"><?= $items[ReestrConst::KEY_ORD]?></div>
    </td>

    <td>
        <div  name="INN" rowid="1"><b><?= $items[ReestrConst::KEY_TIN]?></b></div>
    </td>
    <td>
        <div name="FacNum" rowid="1"><?= $items[ReestrConst::KEY_FAC_NO]?></div>
    </td>
    <td>
        <div name="FacDate" rowid="1"><?= $items[ReestrConst::KEY_FAC_DATE]?></div>
    </td>
    <td>
        <div name="ContNo" rowid="1"><?= $items[ReestrConst::KEY_CONT_NO]?></div>
    </td>
    <td>
        <div name="ConDate" rowid="1"><?= $items[ReestrConst::KEY_CONT_DATE]?></div>
    </td>


    <td>
        <div class="editable" name="ProductName" style="overflow: hidden" rowid="<?= $ord ?>"><b> <?= $items[ReestrConst::KEY_NAME]?></b></div>
    </td>
    <td>
        <div class="editable" name="ProductMeasureId" rowid="<?= $ord ?>"><?= $measure[(int)$items[ReestrConst::KEY_CODE]] ?></div>
    </td>
    <td>
        <div class="editable" name="ProductCount" id="ProductCount_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ReestrConst::KEY_COUNT]?></div>
    </td>
    <td>
        <div class="editable" name="ProductSumma" id="ProductSumma_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ReestrConst::KEY_PRICE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductDeliverSUm" id="ProductFuelSum_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ReestrConst::KEY_DELIVERY_PRICE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductVatRate" id="ProductVatRate_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ReestrConst::KEY_VAT_RATE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductVatSum" id="ProductVatSum_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ReestrConst::KEY_VAT_VALUE]?></div>
    </td>
    <td>
        <div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_<?= $ord ?>" rowid="<?= $ord ?>"><?= $items[ReestrConst::KEY_DELIVERY_WITH_VAT]?></div>
    </td>
    <td  >
        <div   name="ProductFuelRate" id="ProductFuelRate_1" rowid="1"><?= $items[ReestrConst::KEY_FUEL_RATE]?></div>
    </td>
    <td  >
        <div  name="ProductFuelSum" id="ProductFuelSum_1" rowid="1"><?= $items[ReestrConst::KEY_FUEL_VALUE]?></div>
    </td>
    <td >
        <div   name="ProductDeliverySumWithFuel" id="ProductDeliverySumWithFuel_1" rowid="1"><?= $items[ReestrConst::KEY_DELIVERY_WITH_FUEL]?></div>
    </td>

</tr>
<?php $ord ++; }?>