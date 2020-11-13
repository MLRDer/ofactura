<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WebServices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="web-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => 'UZB(Kril)',
                    'content' => $form->field($model, 'name_uz')->textInput(['maxlength' => true]).$form->field($model, 'anons_uz')->textInput(['maxlength' => true]),
                ],
                [
                    'label' => 'OZB(latin)',
                    'content' => $form->field($model, 'name_oz')->textInput(['maxlength' => true]).$form->field($model, 'anons_oz')->textInput(['maxlength' => true]),
                ],
                [
                    'label' => 'RUS',
                    'content' => $form->field($model, 'name_ru')->textInput(['maxlength' => true]).$form->field($model, 'anons_ru')->textInput(['maxlength' => true]),
                ],
            ],
        ]
    ) ?>


    <?= $form->field($model, 'icon')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
