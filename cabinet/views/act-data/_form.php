<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Acts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ActNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ActDate')->textInput() ?>

    <?= $form->field($model, 'ActText')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContractDate')->textInput() ?>

    <?= $form->field($model, 'SellerTin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerTin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ActProductId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
