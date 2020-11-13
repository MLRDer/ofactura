<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
/* @var $form yii\widgets\ActiveForm */

//var_dump($model);die;
?>
<div class="company-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ns10_code')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ns11_code')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'director_tin')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'accountant')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tin')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'oked')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'type')->textInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
