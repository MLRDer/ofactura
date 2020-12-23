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
        <div class="col-md-12">
            <?= Html::a(' Маьлумотларни қайта йуклаш', "/company/update-data",['class' => 'btn btn-warning']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ns10_code')->textInput(['disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true,'disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ns11_code')->textInput(['disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'director')->textInput(['maxlength' => true,'disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'director_tin')->textInput(['disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'accountant')->textInput(['maxlength' => true,'disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tin')->textInput(['disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->textInput(['disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'oked')->textInput(['disabled'=>true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'type')->textInput(['disabled'=>true]) ?>
        </div>
    </div>
    <div class="form-group">

    </div>
    <?php ActiveForm::end(); ?>
</div>
