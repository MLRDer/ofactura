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



    <?php if($model->status==\common\models\DocStatus::NEW_DOC){ ?>
        <button  type="button" name="Send" class="btn btn-success" onclick="SendData(<?= $model->id ?>)"><i class="la la-qrcode"></i> <?= Yii::t('main','Imzolash va jo`natish')?></button>
        <a href="/doc/update?id=<?= $model->id?>" type="button" class="btn btn-info"><i class="la la-pencil-square"></i> <?= Yii::t('main','O`zgartirish')?></a>
        <button onclick='DelteFac(<?= $model->id ?>)' type="button" class="btn btn-danger"><i class="flaticon-delete"></i> <?= Yii::t('main','O`chirish')?></button>
    <?php } else{?>
    <?php if($model->status!==\common\models\DocStatus::CANCELED){ ?>

        <button  type="button" name="Send" class="btn btn-warning" onclick="CancelFacturaData(<?= $model->id ?>)">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Bekor qilish')?>
        </button>
    <?php }}?>




</div>
