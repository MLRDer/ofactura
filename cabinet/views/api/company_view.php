<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-06-08
 * Time: 17:17
 */

?>

<div class="kt-widget1 animated fadeInUp">
    <div class="kt-widget1__item">
        <div class="kt-widget1__info">
            <h3 class="kt-widget1__title"><?= Yii::t('main','BuyerName') ?></h3>
            <span class="kt-widget1__desc"><?= $model['name']?></span>
        </div>
<!--        <span class="kt-widget1__number kt-font-brand">+$17,800</span>-->
    </div>
    <div class="kt-widget1__item">
        <div class="kt-widget1__info">
            <h3 class="kt-widget1__title"><?= Yii::t('main','BuyerAccount') ?></h3>
            <span class="kt-widget1__desc"><?= $model['account']?></span>
        </div>
<!--        <span class="kt-widget1__number kt-font-danger">+1,800</span>-->
    </div>
    <div class="kt-widget1__item">
        <div class="kt-widget1__info">
            <h3 class="kt-widget1__title"><?= Yii::t('main','BuyerBankId') ?></h3>
            <span class="kt-widget1__desc"><?= $model['mfo']?></span>
        </div>
     </div>
    <div class="kt-widget1__item">
        <div class="kt-widget1__info">
            <h3 class="kt-widget1__title"><?= Yii::t('main','BuyerAddress') ?></h3>
            <span class="kt-widget1__desc"><?= $model['address']?></span>
        </div>
    </div>
    <div class="kt-widget1__item">
        <div class="kt-widget1__info">
            <h3 class="kt-widget1__title"><?= Yii::t('main', 'BuyerOked') ?></h3>
            <span class="kt-widget1__desc"><?= $model['oked']?></span>
        </div>
    </div>

    <div class="kt-widget1__item">
        <div class="kt-widget1__info">
            <h3 class="kt-widget1__title"><?= Yii::t('main', 'BuyerVatRegCode') ?></h3>
            <span class="kt-widget1__desc"><?= $model['regCode']?></span>
        </div>
    </div>


</div>
