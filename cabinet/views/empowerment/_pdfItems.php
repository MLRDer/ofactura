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
    <th width="30px">№</th>
    <th ><?= Yii::t('main','ProductName')?></th>
    <th width="40px" ><?= Yii::t('main','ProductMeasureId')?></th>
    <th width="40px" ><?= Yii::t('main','ProductCount')?></th>

</tr>

</thead>
<tbody>
<?php $count = 0;  foreach ($products as $items){
    $count = $count + $items->Count;

    ?>
    <tr>
        <td> </td>
        <td><?= $items->Name ?></td>
        <td><?= $measure[$items->MeasureId] ?></td>
        <td><?= $items->Count ?></td>

    </tr>
<?php }?>
<tr>
    <td colspan="3" align="left"><b><?= Yii::t('main','Jami summa')?></b></td>
    <td> <b><?= $count?></b></td>

</tr>
</tbody>
