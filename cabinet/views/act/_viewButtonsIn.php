<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
?>

    <?php if($model->status==15){ ?>

        <button class="btn-green m-r-20" onclick="AcceptAct('<?= $model->Id ?>')">
            <img src="/new_template/images/icon/signature.svg" alt=""> <span class="title"><?= Yii::t('main','Imzolash')?></span>
        </button>

        <a href="#!" onclick="RejectedAct('<?= $model->Id ?>')" class="btn-outline-red"><?= Yii::t('main','Rad etish')?></a>

    <?php }?>



