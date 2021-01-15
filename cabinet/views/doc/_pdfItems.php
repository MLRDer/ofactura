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
    <th width="90px" rowspan="2"><?= Yii::t('main','ProductFuelSum')?></th>
    <th width="60px" colspan="2" rowspan="1"><?= Yii::t('main','ProductVatRate title')?></th>
    <th width="90px" rowspan="2"> <?= Yii::t('main','ProductDeliverySum')?></th>
</tr>
<tr>
    <th width="60px" rowspan="1"><?= Yii::t('main','ProductVatRate')?></th>
    <th width="60px" rowspan="1"><?= Yii::t('main','ProductVatSum')?></th>
</tr>

</thead>
<tbody>
<?php $all_sum = 0; $nds_sum = 0; $count = 0; $ProductDeliverySum = 0;  foreach ($products as $items){
    $count = $count + $items->ProductCount;
    $all_sum = $all_sum+ $items->ProductDeliverySumWithVat;
    $nds_sum = $nds_sum + $items->ProductVatSum;
    $ProductDeliverySum = $ProductDeliverySum + $items->ProductDeliverySum;
    ?>
    <tr>
        <td><?= $items->SortOreder ?> </td>
        <td><?= $items->ProductName ?></td>
        <td><?= $measure[$items->ProductMeasureId] ?></td>
        <td><?= $items->ProductCount ?></td>
        <td><?= number_format($items->ProductSumma,2) ?></td>
        <td><?= number_format($items->ProductDeliverySum,2) ?></td>
        <td><?= $items->ProductVatRate ?></td>
        <td><?= number_format($items->ProductVatSum,2) ?></td>
        <td><?= number_format($items->ProductDeliverySumWithVat,2) ?></td>
    </tr>
<?php }?>
<tr>
    <td colspan="3" align="left"><b><?= Yii::t('main','Jami summa')?></b></td>
    <td> <b><?= $count?></b></td>
    <td> </td>
    <td><b><?= number_format($ProductDeliverySum,2) ?></b></td>
    <td></td>
    <td> <b><?= number_format($nds_sum,2)?></b></td>

    <td> <b><?= number_format($all_sum,2)?></b></td>
</tr>
</tbody>
