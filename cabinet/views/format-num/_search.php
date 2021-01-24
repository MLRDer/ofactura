<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FormatNoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="format-no-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tin') ?>

    <?= $form->field($model, 'type_doc') ?>

    <?= $form->field($model, 'after_number') ?>

    <?= $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'before_number') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('main', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('main', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
