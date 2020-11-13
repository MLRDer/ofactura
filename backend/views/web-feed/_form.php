<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WebFeedBack */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="web-feed-back-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => 'UZB(Kril)',
                    'content' => $form->field($model, 'name_uz')->textInput(['maxlength' => true]).$form->field($model, 'body_uz')->textarea(['rows' => 6]),
                ],
                [
                    'label' => 'OZB(Lotin)',
                    'content' => $form->field($model, 'name_oz')->textInput(['maxlength' => true]).$form->field($model, 'body_oz')->textarea(['rows' => 6]),
                ],
                [
                    'label' => 'RUS',
                    'content' => $form->field($model, 'name_ru')->textInput(['maxlength' => true]).$form->field($model, 'body_ru')->textarea(['rows' => 6]),
                ],
            ],
        ]
    ) ?>



    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
