<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
?>
<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <a href="/facturas/dublicate?id=<?= $model->Id?>" type="button" class="btn btn-outline-success"><i class="la la-copy"></i> <?= Yii::t('main','Дублировать')?></a>
    <?php if($model->status==\common\models\Facturas::STATUS_NEW || $model->status==\common\models\Facturas::STATUS_REESTR ){ ?> 
        <button  type="button" name="Send" class="btn btn-success" onclick="SendFactura('<?= $model->Id ?>')"><i class="la la-qrcode"></i> <?= Yii::t('main','Imzolash va jo`natish')?></button>
        <a href="/facturas/update?id=<?= $model->Id?>" type="button" class="btn btn-info"><i class="la la-pencil-square"></i> <?= Yii::t('main','O`zgartirish')?></a>
        <button onclick='DelteFactura("<?= $model->Id ?>")' type="button" class="btn btn-danger"><i class="flaticon-delete"></i> <?= Yii::t('main','O`chirish')?></button>
    <?php } else{?>
    <?php if($model->status==\common\models\Facturas::STATUS_SEND){ ?>

        <button  type="button" name="Send" class="btn btn-warning" onclick="CancelFactura('<?= $model->Id ?>')">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Bekor qilish')?>
        </button>
    <?php }}?>




</div>
