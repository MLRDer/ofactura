<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPartsTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="input m-b-30">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>Yii::t('main','Template name'),'class'=>''])->label(false) ?>
    </div>
    <?php ActiveForm::end(); ?>
