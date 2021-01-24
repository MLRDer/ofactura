<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model_contract common\models\FormatNo */
/* @var $model_factura common\models\FormatNo */
/* @var $model_act common\models\FormatNo */

$this->title = Yii::t('main', 'Настройка формат нумерация');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Format Nos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
<div class="white-box">
    <div class="row m-b-20">

        <div class="col-md-12">
            <div class="page-title m-b-0" id="title-create"><?= $this->title ?></div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="input-group input m-t-30">
                <div class="input-group-prepend">
                    <span class="input-group-text" id=""><?= Yii::t('main','Формат номера договора')?> </span>
                </div>

                <input type="text" name="after_num_contract" class="form-control" value="<?= $model_contract->after_number ?>">
                <input type="text" name="num_contract" class="form-control" value="<?= $model_contract->number ?>">
                <input type="text" name="before_num_contract" class="form-control" value="<?= $model_contract->before_number ?>">
            </div>
            <div style="text-align: right">
                <i><?= Yii::t('main','Следующий договора получит этот номер')?></i>
            </div>
        </div>
        <div class="col-md-6">
            <label class="invoice-checkbox m-t-40">
                <div class="title"><?= Yii::t('main','отключить автонумерацию')?></div>
                <input type="checkbox" name="enabled_contract" <?= ($model_contract->enabled==1)?'checked':''?>>
                <div class="switch-checkbox"></div>
            </label>
        </div>

        <div class="col-md-6">
            <div class="input-group input m-t-30">
                <div class="input-group-prepend">
                    <span class="input-group-text" id=""><?= Yii::t('main','Формат номера фактура')?> </span>
                </div>
                <input type="text" name="after_num_factura" class="form-control" value="<?= $model_factura->after_number?>">
                <input type="text" name="num_factura" class="form-control" value="<?= $model_factura->number?>">
                <input type="text" name="before_num_factura" class="form-control" value="<?= $model_factura->before_number?>">

            </div>
            <div style="text-align: right">
                <i><?= Yii::t('main','Следующий фактура получит этот номер')?></i>
            </div>
        </div>
        <div class="col-md-6">
            <label class="invoice-checkbox m-t-40">
                <div class="title"><?= Yii::t('main','отключить автонумерацию')?></div>
                <input type="checkbox"  name="enabled_factura" <?= ($model_factura->enabled==1)?'checked':''?>>
                <div class="switch-checkbox"></div>
            </label>
        </div>

        <div class="col-md-6">
            <div class="input-group input m-t-30">
                <div class="input-group-prepend">
                    <span class="input-group-text" id=""><?= Yii::t('main','Формат номера акть')?> </span>
                </div>
                <input type="text" name="after_num_act" class="form-control" value="<?= $model_act->after_number ?>">
                <input type="text" name="num_act" class="form-control" value="<?= $model_act->number ?>">
                <input type="text" name="before_num_act" class="form-control" value="<?= $model_act->before_number ?>">
            </div>
            <div style="text-align: right">
                <i><?= Yii::t('main','Следующий акть получит этот номер')?></i>
            </div>
        </div>
        <div class="col-md-6">
            <label class="invoice-checkbox m-t-40">
                <div class="title"><?= Yii::t('main','отключить автонумерацию')?></div>
                <input type="checkbox" name="enabled_act" <?= ($model_act->enabled==1)?'checked':''?>>
                <div class="switch-checkbox"></div>
            </label>
        </div>

        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'btn-green']) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>

