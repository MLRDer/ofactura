<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
?>

    <?php if($model->status==\common\models\Docs::NO_ACCEPTED){ ?>
        <button  type="button" name="Send" class="btn-green m-r-20" onclick="AcceptEmpowerment(<?= $model->id ?>)">
            <img src="/new_template/images/icon/signature.svg" alt=""> <span class="title"> <?= Yii::t('main','Imzolash')?></span>
        </button>
        <button  type="button" name="Send" class="btn-outline-red" onclick="RejectedData(<?= $model->id ?>)">
            <?= Yii::t('main','Rad etish')?>
        </button>
    <?php }?>



    <?php if($model->status==\common\models\DocStatus::NEW_DOC){ ?>
<ul class="btn-list">
    <li class="btn-item">
        <a href="#!"  type="button" name="Send" class="btn-link" onclick="SendEmpowerment(<?= $model->id ?>)">
            <img src="/new_template/images/icon/signature.svg" alt="">
            <span class="title"><?= Yii::t('main','Imzolash va jo`natish')?></span>
        </a>
    </li>
    <li class="btn-item">
        <a href="/empowerment/update?id=<?= $model->id?>" type="button" class="btn-link">
            <img src="/new_template/images/icon/edit.svg" alt="">
            <span class="title"><?= Yii::t('main','O`zgartirish')?></span>
        </a>
    </li>
    <li class="btn-item">
        <a href="#" onclick='DelteEmpowerment(<?= $model->id ?>)' type="button" class="btn-link">
            <img src="/new_template/images/icon/delete.svg" alt="">
            <span class="title"> <?= Yii::t('main','O`chirish')?></span>
        </a>
    </li>
</ul>
    <?php } else{?>
    <?php if($model->status!==\common\models\DocStatus::CANCELED){ ?>

        <button  type="button" name="Send" class="btn-outline-red" onclick="CancelEmpData(<?= $model->id ?>)">
            <?= Yii::t('main','Bekor qilish')?>
        </button>
    <?php }}?>


