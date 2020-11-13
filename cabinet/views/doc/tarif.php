<?php

use common\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Docs */

$this->title = "Tariflar";
$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z" id="Rectangle-19-Copy-3" fill="#000000"/>
    </g>
</svg>
										</span>
            <h3 class="kt-portlet__head-title">
                <?= $this->title ?>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <?= Alert::widget() ?>
        <div class="kt-pricing-1">

            <div class="kt-pricing-1__items row">
                <?php foreach ($model as $items){ ?>
                <div class="kt-pricing-1__item col-lg-3">
                    <?= $items->icon ?>
                    <span class="kt-pricing-1__price"><?= $items->name ?></span>
                    <h2 class="kt-pricing-1__subtitle"><?= Yii::t('main','Bitta xujjat narxi')?> <?= number_format($items->price,0) ?> <?= Yii::t('main','so`m') ?></h2>
                    <span class="kt-pricing-1__description">
                                <span><?= Yii::t('main','Abonent to`lovi oyiga')?> <b> <?= number_format($items->month_mony,0)?></b> <?= Yii::t('main',"so'm")?></span>
                        <span><?= Yii::t('main','Faolashtirish narxi')?>  <b> <?= number_format($items->price*$items->value_doc,0) ?></b> <?= Yii::t('main',"so`m")?></span>




												</span>
                    <div class="kt-pricing-1__btn">
                        <?php if($items->id==\cabinet\models\Components::getTarif('id')){ ?>
<!--                        <a href="#" class="btn btn-success btn-custom btn-pill btn-wide btn-uppercase btn-bolder btn-sm">-->
<!--                           <i class="flaticon2-correct"></i> --><?//= Yii::t('main','Faolashtirilgan')?>
<!--                        </a>-->
                        <?php } else {?>
<!--                            <a href="/doc/set-tarif?id=--><?//= $items->id ?><!--" class="btn btn-brand btn-custom btn-pill btn-wide btn-uppercase btn-bolder btn-sm"><i class="flaticon2-checkmark"></i> --><?//= Yii::t('main',"Tarifga o'tish")?><!--</a>-->
                        <?php }?>

                    </div>
                </div>
                 <?php }?>
            </div>
        </div>
    </div>
</div>
<style>
    .kt-pricing-1__price{
        color: black!important;

    }
    .kt-pricing-1 .kt-pricing-1__items .kt-pricing-1__item .kt-pricing-1__subtitle {

        color:#000!important;

    }
    .kt-pricing-1 .kt-pricing-1__items .kt-pricing-1__item .kt-pricing-1__description {

        color:#000!important;

    }
    .btn.btn-pill {
        -webkit-box-shadow: 0px 4px 16px 0px rgba(153, 153, 153, 0.15);
        box-shadow: 0px 4px 16px 0px rgba(153, 153, 153, 0.15);
    }
    /*.fade:not(.show) {*/
        /*opacity: 1!important;*/
    /*}*/
</style>