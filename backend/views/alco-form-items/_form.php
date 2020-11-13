<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AlcoFormItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alco-form-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'label_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'input_type')->dropDownList(['1'=>'Text','2'=>'Spravochnik','3'=>'Number']) ?>

    <?= $form->field($model, 'is_recured')->checkbox() ?>

    <?= $form->field($model, 'placeholder_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'placeholder_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'col_size_class')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
