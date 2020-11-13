<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Tizimga kirish';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-4">
</div>
<div class="col-md-4">
<div class="panel">
    <div class="panel-heading" style="text-align: center">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body" id="LoginArea">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
</div>
</div>
<div class="col-md-4">
</div>