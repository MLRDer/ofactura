<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-22
 * Time: 19:36
 */
?>


<thead style="text-align: center">
<tr>
    <th width="30px" rowspan="2">№</th>
    <th rowspan="2"><?= Yii::t('main','ProductName')?></th>
    <th width="40px" rowspan="2"><?= Yii::t('main','ProductMeasureId')?></th>
    <th width="40px" rowspan="2"><?= Yii::t('main','ProductCount')?></th>
    <th width="60px" rowspan="2"><?= Yii::t('main','ProductSumma')?></th>
    <th width="90px" rowspan="2"><?= Yii::t('main','ProductDeliverySum')?></th>

    <th width="60px" colspan="2" rowspan="1"><?= Yii::t('main','ProductFuelRate title')?></th>
    <th width="90px" rowspan="2"> <?= Yii::t('main','ProductDeliverySumWithVat')?></th>

    <th width="60px" colspan="2" rowspan="1"><?= Yii::t('main','ProductVatRate title')?></th>
    <th width="90px" rowspan="2"> <?= Yii::t('main','ProductDeliverySumWithVat')?></th>


</tr>
<tr>
    <th width="60px" rowspan="1"><?= Yii::t('main','ProductVatRate')?></th>
    <th width="60px" rowspan="1"><?= Yii::t('main','ProductVatSum')?></th>

    <th width="60px" rowspan="1"><?= Yii::t('main','ProductFuelRate')?></th>
    <th width="60px" rowspan="1"><?= Yii::t('main','ProductFuelSum')?></th>
</tr>

</thead>
<tbody>
<?php $all_sum = 0; $nds_sum = 0; $count = 0; $ProductDeliverySum = 0; $fuel_sum = 0; $all_fuel = 0;  foreach ($products as $items){
    $count = $count + $items->Count;
    $all_sum = $all_sum+ $items->DeliverySumWithVat;
    $nds_sum = $nds_sum + $items->VatSum;
    $ProductDeliverySum = $ProductDeliverySum + $items->DeliverySum;
    $fuel_sum = $fuel_sum + $items->ExciseSum;
    $all_fuel = $all_fuel + $items->DeliverySumWithVat;
    ?>
    <tr>
        <td><?= $items->OrdNo ?> </td>
        <td><?= $items->Name ?></td>
        <td><?= $measure[$items->MeasureId] ?></td>
        <td><?= $items->Count ?></td>
        <td><?= number_format($items->Summa,2) ?></td>
        <td><?= number_format($items->DeliverySum,2) ?></td>

        <td><?= $items->ExciseRate ?></td>
        <td><?= number_format($items->ExciseSum,2) ?></td>
        <td><?= number_format($items->DeliverySumWithVat,2) ?></td>

        <td><?= $items->VatRate ?></td>
        <td><?= number_format($items->VatSum,2) ?></td>
        <td><?= number_format($items->DeliverySumWithVat,2) ?></td>



    </tr>
<?php }?>
<tr>
    <td colspan="3" align="left"><b><?= Yii::t('main','Jami summa')?></b></td>
    <td> <b><?= $count?></b></td>
    <td> </td>
    <td><b><?= number_format($ProductDeliverySum,2) ?></b></td>
    <td></td>
    <td><b><?= number_format($fuel_sum,2)?></b></td>
    <td><b><?= number_format($all_fuel,2)?></b></td>

    <td></td>


    <td> <b><?= number_format($nds_sum,2)?></b></td>
    <td> <b><?= number_format($all_sum,2)?></b></td>
</tr>
</tbody>

