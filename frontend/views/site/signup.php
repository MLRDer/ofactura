<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


        <div class="col-lg-4">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>

        <div class="col-lg-6">
                <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-lg-6">
                <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
        </div>
            <?php ActiveForm::end(); ?>
        </div>

</div>
