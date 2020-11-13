<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
?>
<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <?php if($model->status==15){ ?>
        <button  type="button" name="Send" class="btn btn-brand" onclick="AcceptFactura('<?= $model->Id ?>')">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Imzolash')?>
        </button>
        <button  type="button" name="Send" class="btn btn-danger" onclick="RejectedFactura('<?= $model->Id ?>')">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Rad etish')?>
        </button>
    <?php }?>


</div>
