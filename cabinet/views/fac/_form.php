<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Factura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Version')->textInput() ?>

    <?= $form->field($model, 'FacturaType')->textInput() ?>

    <?= $form->field($model, 'SingleSidedType')->textInput() ?>

    <?= $form->field($model, 'FacturaNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FacturaDate')->textInput() ?>

    <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContractDate')->textInput() ?>

    <?= $form->field($model, 'AgentFacturaId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmpowermentNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmpowermentDateOfIssue')->textInput() ?>

    <?= $form->field($model, 'AgentFio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AgentTin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ItemReleasedFio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerTin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerTin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerBankId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerWorkPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerOked')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerDistrictId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerDirector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAccountant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerVatRegCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerBranchCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerBranchName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerBankId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerWorkPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerOked')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerDistrictId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerDirector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAccountant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerVatRegCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerBranchCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerBranchName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FacturaProductId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HasVat')->textInput() ?>

    <?= $form->field($model, 'HasExcise')->textInput() ?>

    <?= $form->field($model, 'HasCommittent')->textInput() ?>

    <?= $form->field($model, 'HasMedical')->textInput() ?>

    <?= $form->field($model, 'AllSum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AllVatSum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
