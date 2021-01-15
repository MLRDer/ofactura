<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'doc_id') ?>

    <?= $form->field($model, 'SortOreder') ?>

    <?= $form->field($model, 'ProductName') ?>

    <?php // echo $form->field($model, 'ProductMeasureId') ?>

    <?php // echo $form->field($model, 'ProductCount') ?>

    <?php // echo $form->field($model, 'ProductSumma') ?>

    <?php // echo $form->field($model, 'ProductDeliverySum') ?>

    <?php // echo $form->field($model, 'ProductVatRate') ?>

    <?php // echo $form->field($model, 'ProductVatSum') ?>

    <?php // echo $form->field($model, 'ProductDeliverySumWithVat') ?>

    <?php // echo $form->field($model, 'ProductFuelRate') ?>

    <?php // echo $form->field($model, 'ProductFuelSum') ?>

    <?php // echo $form->field($model, 'ProductDeliverySumWithFuel') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
