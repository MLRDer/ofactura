<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyExtra */
/* @var $form yii\widgets\ActiveForm */

$url = \yii\helpers\Url::to(['company-list']);
?>

<div class="company-extra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'company_id')->widget(Select2::classname(), [
        'options' => ['multiple'=>false, 'placeholder' => 'ИНН ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(city) { return city.text; }'),
            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
        ],
    ]);
    ?>

    <?= $form->field($model, 'extra_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ExtraFunction::find()->all(),'id','name_uz')) ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
