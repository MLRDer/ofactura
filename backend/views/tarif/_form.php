<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyTarif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-tarif-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'period')->dropDownList(["1"=>"1","3"=>"3","6"=>"6","12"=>"12"]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'value_doc')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'month_mony')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'enabled')->checkbox() ?>
        </div>
    </div>















  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
