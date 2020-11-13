<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
?>
<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <?php if($model->status==\common\models\Docs::NO_ACCEPTED){ ?>
        <button  type="button" name="Send" class="btn btn-brand" onclick="AcceptEmpowerment(<?= $model->id ?>)">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Imzolash')?>
        </button>
        <button  type="button" name="Send" class="btn btn-danger" onclick="RejectedData(<?= $model->id ?>)">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Rad etish')?>
        </button>
    <?php }?>



    <?php if($model->status==\common\models\DocStatus::NEW_DOC){ ?>
        <button  type="button" name="Send" class="btn btn-success" onclick="SendEmpowerment(<?= $model->id ?>)"><i class="la la-qrcode"></i> <?= Yii::t('main','Imzolash va jo`natish')?></button>
        <a href="/empowerment/update?id=<?= $model->id?>" type="button" class="btn btn-info"><i class="la la-pencil-square"></i> <?= Yii::t('main','O`zgartirish')?></a>
        <button onclick='DelteEmpowerment(<?= $model->id ?>)' type="button" class="btn btn-danger"><i class="flaticon-delete"></i> <?= Yii::t('main','O`chirish')?></button>
    <?php } else{?>
    <?php if($model->status!==\common\models\DocStatus::CANCELED){ ?>

        <button  type="button" name="Send" class="btn btn-warning" onclick="CancelEmpData(<?= $model->id ?>)">
            <i class="la la-qrcode"></i> <?= Yii::t('main','Bekor qilish')?>
        </button>
    <?php }}?>




</div>
