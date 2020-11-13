<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
?>
<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <?php if($model->status==5){ ?>
        <button  type="button" name="Send" class="btn btn-brand" onclick="AcceptData(<?= $model->id ?>)">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Imzolash')?>
        </button>
        <button  type="button" name="Send" class="btn btn-danger" onclick="RejectedData(<?= $model->id ?>)">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Rad etish')?>
        </button>
    <?php }?>


</div>
