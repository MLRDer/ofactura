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
<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column align-items-start">
                    <div class="page-title m-b-10">Доверенность <span class="number">№ <?= $model->EmpowermentNo?></span>
                    </div>
                    <?php  if($model->type==\common\models\Docs::TYPE_OUT){ ?>
                        <span class="badge yellow"><?= Yii::t('main','Chiquvchi xujjat')?></span>
                    <?php }?>
                    <?php  if($model->type==\common\models\Docs::TYPE_IN){ ?>
                        <span class="badge yellow"><?= Yii::t('main','Kiruvchi xujjat')?></span>
                    <?php }?>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <?php if($model->type==\common\models\Docs::TYPE_OUT){ ?>
                        <?= $this->render('_viewButtons',['model'=>$model])?>
                    <?php } else {?>
                        <?= $this->render('_viewButtonsIn',['model'=>$model])?>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" id="doc_sign" name="doc_sign" value='<?= $model->docs_pks7 ?>'>

            <?php
            $CanseledJson = [
                'EmpowermentId'=>$model->EmpowermentId,
                'BuyerTin'=>$model->BuyerTin
            ];
            ?>
            <input type="hidden" id="CaneledValue" name="caneled_value" value='<?= \yii\helpers\Json::encode($CanseledJson)?>'>
            <div class="pdf-wrapper">
                <object data="/empowerment/pdf?id=<?= $model->id ?>" type="application/pdf" width="100%" height="650"></object>
            </div>
        </div>
    </div>
</div>