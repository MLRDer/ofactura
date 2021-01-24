<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPartsTemplateItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-parts-template-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'template_id') ?>

    <?= $form->field($model, 'OrdNo') ?>

    <?= $form->field($model, 'Title') ?>

    <?= $form->field($model, 'Body') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
