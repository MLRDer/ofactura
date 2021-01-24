<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contracts */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column align-items-start">
                    <div class="page-title m-b-10">
                        <?= Yii::t('main', 'Contract');?> <?= "<span class='number'>№ ".$model->ContractNo."</span>";?>
                    </div>
                    <div>
                        <?php if($model->Tin==\cabinet\models\Components::CompanyData('tin')){ ?>
                            <span class="badge gray">
                            <?= Yii::t('main','Chiquvchi xujjat')?>
                        </span>
                        <?php } else {?>
                            <span class="badge green">
                            <?= Yii::t('main','Kiruvchi xujjat')?>
                        </span>
                        <?php }?>

                        <span class="badge yellow">
                            <?= \common\models\Contracts::getStatus($model->status)?>
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <a href="/contracts/view?id=<?= $model->Id?>&type=<?= Yii::$app->request->get('type')==1?0:1?>" class="btn-outline-yellow m-r-20"><img src="/img/orientation-961.png" style="width:24px;margin-right:0px"> </a>
                    <?php if($model->Tin==\cabinet\models\Components::CompanyData('tin')){ ?>
                        <?= $this->render('_viewButtons',['model'=>$model])?>
                    <?php } else {?>
                        <?= $this->render('_viewButtonsIn',['model'=>$model])?>
                    <?php }?>
                    <!--                    <a href="#!" class="btn-outline-yellow m-r-20">-->
                    <!--                        <img src="images/icon/copy-yellow.svg" alt=""> <span class="title">дублировать </span>-->
                    <!--                    </a>-->
                    <!--                                        <a href="#!" class="btn-gray"> </a>-->
                </div>
            </div>
        </div>
        <div class="col-md-12 m-t-20">
            <?php
            if($model->status==\common\models\Contracts::STATUS_REJECTED){
                ?>
<!--                <div class="alert alert-danger">--><?//= $model->notes?><!--</div>-->
            <?php }?>
        </div>
    </div>

    <div class="kt-portlet__body">


        <div class="row">
            <div class="col-md-12">
                <div class="pdf-wrapper">
                    <?php
                    $CanseledJson = [
                        'ActId'=>$model->Id,
                        'SellerTin'=>$model->Tin
                    ];
                    ?>
                    <input type="hidden" id="CaneledValue" name="caneled_value" value='<?= \yii\helpers\Json::encode($CanseledJson)?>'>
                    <object data="/contracts/pdf?id=<?= $model->Id ?>&type=<?= Yii::$app->request->get('type')?>" type="application/pdf" width="100%" height="650"></object>
                </div>
            </div>
        </div>
    </div>


    <style>
        table tr td{
            color: black;
            vertical-align: center;
        }
        .labelFactura{
            font-weight: bold;
            color: black;
        }
    </style>

