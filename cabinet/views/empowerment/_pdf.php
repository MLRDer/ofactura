<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-08
 * Time: 23:56
 */
use Da\QrCode\QrCode;

$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name');

$qrCode = (new QrCode('{INN:'.\cabinet\models\Components::CompanyData('tin').', Factura_id: '.$model->EmpowermentId.' }'))
    ->setSize(80)
    ->setMargin(5)
    ->useForegroundColor(0, 0, 0);

// now we can display the qrcode in many ways
// saving the result to a file:

//$qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified

// display directly to the browser
//header('Content-Type: '.$qrCode->getContentType());
//echo $qrCode->writeString();

?>

    <div style="text-align: center;font-weight: bold;font-size: 14px;color: black">
         <table width="100%">
             <tr>
                 <td width="33%">

                 </td>
                 <td width="33%" align="center" style="font-weight:bold;font-size:12px;">
                     ДОВЕРЕННОСТЬ № <?= $model->EmpowermentNo ?>
                 </td>
                 <td width="33%" align="right">
                     <img src="<?= $qrCode->writeDataUri()?>">
                 </td>

             </tr>
         </table>






    </div>
    <div>

                    <table width="100%" style="font-size: 10px">
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b><?= Yii::t('main','Организация')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->BuyerName ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b><?= Yii::t('main','Дата выдачи')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->EmpowermentDateOfIssue ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b><?= Yii::t('main','Доверенность действительна до')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->EmpowermentDateOfExpire ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b><?= Yii::t('main','Наименование потребителя')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->BuyerName ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b><?= Yii::t('main','Адрес')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->BuyerAddress ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>  <?= Yii::t('main','ИНН')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->BuyerTin ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>  <?= Yii::t('main','Номер счета')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->BuyerAccount ?>, <?= Yii::t('main','MFO')?>: <?= $model->BuyerBankId ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>   <?= Yii::t('main','Доверенность выдана')?>:</b>

                            </td>
                            <td width="65%" align="left">
                                <b><?= Yii::t('main','Должность')?></b>: <?= $model->AgentJobTitle ?>
                                <b><?= Yii::t('main','ФИО')?></b>: <?= $model->AgentFio ?>
                                <b><?= Yii::t('main','ИНН')?></b>: <?= $model->AgentTin ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>   <?= Yii::t('main','Серия и номер паспорта')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->AgentPassportNumber ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>   <?= Yii::t('main','Кем выдан')?>:</b>
                            </td>
                            <td width="65%" align="left">
                                <?= $model->AgentPassportIssuedBy ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>   <?= Yii::t('main','Дата выдачи')?>:</b>

                            </td>
                            <td width="65%" align="left">
                                <?= $model->AgentPassportDateOfIssue ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>   <?= Yii::t('main','На получение от')?>:</b>

                            </td>
                            <td width="65%" align="left">

                                <?= $model->SellerName ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="35%" align="right" class="labelFactura">
                                <b>   <?= Yii::t('main','Материальных ценностей по
договору')?>:</b>

                            </td>
                            <td width="65%" align="left">
                                № <?= $model->ContractNo ?> от <?= $model->ContractDate ?>
                            </td>

                        </tr>
                    </table>

    </div>
<div style="text-align:center;">
    <b>Перечень товарно-материальных ценностей, подлежащих получению</b>
</div>
        <table class="table table-bordered factura-grid" style="font-size: 8px;border-color: black;">



                <?= $this->render('_pdfItems', [
                    'products' => $products,
                    'measure'=>$measure

                ]) ?>


        </table>
        <table width="100%" style="font-size: 11px">
            <tr>
                <td width="100%">
                    <div><b><?= Yii::t('main','Подпись получившего')?>:  ______________</b>  <span>удост оверяем</span> </div>
                    <div><b><?= Yii::t('main','Руководитель')?>: ______________</b><span><?= $model->BuyerDirector ?></span> </div>
                    <div><b><?= Yii::t('main','Глав. бух')?>:  ______________</b><span><?= $model->BuyerAccountant ?></span> </div>

                </td>
</tr>

        </table>
    </div>
</div>
