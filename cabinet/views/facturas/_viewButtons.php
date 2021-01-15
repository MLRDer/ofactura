<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
?>

    <a href="/facturas/dublicate?id=<?= $model->Id?>" class="btn-outline-yellow m-r-20">
        <img src="/new_template/images/icon/copy-yellow.svg" alt=""> <span class="title"><?= Yii::t('main','Дублировать')?> </span>
    </a>


    <?php if($model->status==\common\models\Facturas::STATUS_NEW || $model->status==\common\models\Facturas::STATUS_REESTR ){ ?>

        <ul class="btn-list">
            <li class="btn-item">
                <a href="#!" name="Send" class="btn-link" onclick="SendFactura('<?= $model->Id ?>')">
                    <img src="/new_template/images/icon/signature.svg" alt="">
                    <span class="title"><?= Yii::t('main','Imzolash va jo`natish')?></span>
                </a>
            </li>
            <li class="btn-item">

                <a href="/facturas/update?id=<?= $model->Id?>" type="button" class="btn-link">
                    <img src="/new_template/images/icon/edit.svg" alt="">
                    <span class="title">
                        <?= Yii::t('main','O`zgartirish')?>
                    </span>
                </a>
            </li>
            <li class="btn-item">
                <a href="#!" onclick='DelteFactura("<?= $model->Id ?>")' type="button" class="btn-link">
                    <img src="/new_template/images/icon/delete.svg" alt="">
                    <span class="title">
                        <?= Yii::t('main','O`chirish')?>
                    </span>
                </a>
            </li>
        </ul>





    <?php } else{?>
    <?php if($model->status==\common\models\Facturas::STATUS_SEND){ ?>

        <a href="#!" name="Send" class="btn-outline-red" onclick="CancelFactura('<?= $model->Id ?>')">
            <?= Yii::t('main','Bekor qilish')?>
        </a>
    <?php }}?>





