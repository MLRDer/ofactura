<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Docs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'FacturaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FacturaNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FacturaDate')->textInput() ?>

    <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContractDate')->textInput() ?>

    <?= $form->field($model, 'EmpowermentNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmpowermentDateOfIssue')->textInput() ?>

    <?= $form->field($model, 'AgentFio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AgentTin')->textInput() ?>

    <?= $form->field($model, 'AgentFacturaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ItemReleasedFio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerTin')->textInput() ?>

    <?= $form->field($model, 'SellerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerBankId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerWorkPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerOked')->textInput() ?>

    <?= $form->field($model, 'SellerDistrictId')->textInput() ?>

    <?= $form->field($model, 'SellerDirector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAccountant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerVatRegCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerTin')->textInput() ?>

    <?= $form->field($model, 'BuyerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerBankId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerWorkPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerOked')->textInput() ?>

    <?= $form->field($model, 'BuyerDistrictId')->textInput() ?>

    <?= $form->field($model, 'BuyerDirector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAccountant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerVatRegCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docs_pks7')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'json_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'json_items')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'send_date')->textInput() ?>

    <?= $form->field($model, 'accepted_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'type_doc')->textInput() ?>

    <?= $form->field($model, 'enabled')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'HasFuel')->textInput() ?>

    <?= $form->field($model, 'HasVat')->textInput() ?>

    <?= $form->field($model, 'notes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FacturaProductId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reestr_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
