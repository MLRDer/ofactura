<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReestrMain */

$this->title = Yii::t('main','Create Reestr Main');
$this->params['breadcrumbs'][] = ['label' => 'Reestr Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-6">
            <div class="page-title m-b-0" id="title-create"><?= $this->title?></div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">


                <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
            </div>
        </div>
    </div>
</div>