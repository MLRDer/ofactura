<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Empowerment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empowerment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'EmpowermentNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EmpowermentDateOfIssue')->textInput() ?>

    <?= $form->field($model, 'EmpowermentDateOfExpire')->textInput() ?>

    <?= $form->field($model, 'ContractNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ContractDate')->textInput() ?>

    <?= $form->field($model, 'AgentEmpowermentId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AgentTin')->textInput() ?>

    <?= $form->field($model, 'AgentJobTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AgentPassportNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AgentFio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AgentPassportDateOfIssue')->textInput() ?>

    <?= $form->field($model, 'AgentPassportIssuedBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerTin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerBankId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerWorkPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerOked')->textInput() ?>

    <?= $form->field($model, 'SellerDistrictId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerDirector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SellerAccountant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerTin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAccount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerBankId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerMobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerWorkPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerOked')->textInput() ?>

    <?= $form->field($model, 'BuyerDistrictId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerDirector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BuyerAccountant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'items_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'docs_pks7')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'enabled')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
