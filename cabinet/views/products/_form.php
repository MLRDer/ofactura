<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DocProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'doc_id')->textInput() ?>

    <?= $form->field($model, 'SortOreder')->textInput() ?>

    <?= $form->field($model, 'ProductName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ProductMeasureId')->textInput() ?>

    <?= $form->field($model, 'ProductCount')->textInput() ?>

    <?= $form->field($model, 'ProductSumma')->textInput() ?>

    <?= $form->field($model, 'ProductDeliverySum')->textInput() ?>

    <?= $form->field($model, 'ProductVatRate')->textInput() ?>

    <?= $form->field($model, 'ProductVatSum')->textInput() ?>

    <?= $form->field($model, 'ProductDeliverySumWithVat')->textInput() ?>

    <?= $form->field($model, 'ProductFuelRate')->textInput() ?>

    <?= $form->field($model, 'ProductFuelSum')->textInput() ?>

    <?= $form->field($model, 'ProductDeliverySumWithFuel')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'enabled')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
