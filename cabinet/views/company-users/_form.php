<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyUsers */
/* @var $form yii\widgets\ActiveForm */

$data_ru = [
  '11'=>'Отправка/отмена ЭСФ',
  '12'=>'Подтверждение/отклонение ЭСФ',
  '21'=>'Отправка/отмена доверенности',
  '22'=>'Подтверждение/отклонение доверенности',
  '31'=>'Отправка/отмена ТТН',
  '32'=>'Подтверждение/отклонение ТТН',
  '41'=>'Отправка/отмена акта',
  '42'=>'Подтверждение/отклонение акта',
];


?>

<div class="company-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group ">
                <label><?= Yii::t('main','STIR')?></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="SearchTINinput" placeholder="<?= Yii::t('main','Jsimoniy shaxs STIR ini kiriting')?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="SearchPhysic()" id="SearchTinBtn" type="button"><?= Yii::t('main','Izlash!')?></button>
                    </div>
                </div>
            </div>
            <?= $form->field($model, 'tin')->hiddenInput(['placeholder'=>'Jsimoniy shaxs STIR ini kiriting'])->label(false) ?>

            <?= $form->field($model, 'role_items')->checkboxList($data_ru) ?>
        </div>
        <div class="col-md-6" id="resultSearchArea">

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    .form-group label {

        width: 100%;
    }
</style>