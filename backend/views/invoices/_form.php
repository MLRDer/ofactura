<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Invoices */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="invoices-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'reason')->textarea(['rows'=>6]) ?>



  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
