<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPartsTemplateItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-parts-template-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'template_id')->textInput() ?>

    <?= $form->field($model, 'OrdNo')->textInput() ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Body')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
