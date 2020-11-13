<?php

use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WebMenyu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="web-menyu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\WebMenyu::findAll('parent_id is_null'),'id','name_uz'),['prompt'=>'Tanlang...']) ?>
    <hr></hr>
    <?= Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => 'UZB(Kril)',
                    'content' => $form->field($model, 'name_uz')->textInput(['maxlength' => true]),
                ],
                [
                    'label' => 'OZB(Lotin)',
                    'content' => $form->field($model, 'name_oz')->textInput(['maxlength' => true])
                ],
                [
                    'label' => 'RUS',
                    'content' => $form->field($model, 'name_ru')->textInput(['maxlength' => true]),
                ],
            ],
        ]
    ) ?>

<hr></hr>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->textInput() ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
