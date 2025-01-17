<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Empowerment */

$this->title = Yii::t('main', "Dovernost");
$this->params['breadcrumbs'][] = ['label' => 'Empowerments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="kt-portlet kt-portlet--responsive-mobile">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
        <path d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z" id="Combined-Shape" fill="#000000"/>
    </g>
</svg>
												</span>
            <h3 class="kt-portlet__head-title">
                <?= $this->title ?>
                <?php  if($model->type==\common\models\Docs::TYPE_OUT){ ?>
                    <span class="btn btn-label-warning-o2 btn-pill"><?= Yii::t('main','Chiquvchi xujjat')?></span>
                <?php }?>
                <?php  if($model->type==\common\models\Docs::TYPE_IN){ ?>
                    <span class="btn btn-label-success-o2 btn-pill"><?= Yii::t('main','Kiruvchi xujjat')?></span>
                <?php }?>

                <span class="btn btn-label-<?= \common\models\DocStatus::getStatusClass($model->status)?> btn-pill">
                    <?= \common\models\DocStatus::getStatusName($model->status)?>
                </span>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <?php if($model->type==\common\models\Docs::TYPE_OUT){ ?>
                <?= $this->render('_viewButtons',['model'=>$model])?>
            <?php } else {?>
                <?= $this->render('_viewButtonsIn',['model'=>$model])?>
            <?php }?>
        </div>
    </div>
    <input type="hidden" id="doc_sign" name="doc_sign" value='<?= $model->docs_pks7 ?>'>

    <?php
    $CanseledJson = [
        'EmpowermentId'=>$model->EmpowermentId,
        'BuyerTin'=>$model->BuyerTin
    ];
    ?>

    <input type="hidden" id="CaneledValue" name="caneled_value" value='<?= \yii\helpers\Json::encode($CanseledJson)?>'>
    <div class="kt-portlet__body">
        <object data="/empowerment/pdf?id=<?= $model->id ?>" type="application/pdf" width="100%" height="650"></object>
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
