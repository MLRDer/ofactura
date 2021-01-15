<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ActDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'ActNo') ?>

    <?= $form->field($model, 'ActDate') ?>

    <?= $form->field($model, 'ActText') ?>

    <?= $form->field($model, 'ContractNo') ?>

    <?php // echo $form->field($model, 'ContractDate') ?>

    <?php // echo $form->field($model, 'SellerTin') ?>

    <?php // echo $form->field($model, 'SellerName') ?>

    <?php // echo $form->field($model, 'BuyerTin') ?>

    <?php // echo $form->field($model, 'BuyerName') ?>

    <?php // echo $form->field($model, 'ActProductId') ?>

    <?php // echo $form->field($model, 'Tin') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
