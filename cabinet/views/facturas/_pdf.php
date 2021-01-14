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

$qrCode = (new QrCode('{INN:'.\cabinet\models\Components::CompanyData('tin').', Factura_id: '.$model->Id.' }'))
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
         <table>
             <tr>
                 <td colspan="3">
                     ID: <?= $model->Id?>
                 </td>
             </tr>
             <tr>
                 <td width="33%">

                 </td>
                 <td width="33%" align="center" style="font-weight:bold;font-size:12px;">
                     <?= Yii::t('main','СЧЕТ-ФАКТУРА № {FacturaNo}  от {FacturaDate} <div><div> к товарно-отгрузочным документам № {ContractNo} от {ContractDate} </div>',[
                         'FacturaNo'=>$model->FacturaNo,
                         'FacturaDate'=>date("d.m.Y",strtotime($model->FacturaDate)),
                         'ContractNo'=>$model->ContractNo,
                         'ContractDate'=>date("d.m.Y",strtotime($model->ContractDate)),
                     ])?>
                 </td>
                 <td width="33%" align="right">
                     <img src="<?= $qrCode->writeDataUri()?>">
                 </td>

             </tr>
         </table>






    </div>
    <div>
        <table width="100%">
            <tr>
                <td width="50%" align="center">
                    <table width="100%" style="font-size: 10px">
                        <tr>
                            <td width="25%" align="left" class="labelFactura">
                                <b><?= Yii::t('main','SellerName')?></b>
                            </td>
                            <td width="25%" align="left">
                                <?= $model->SellerName ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="25%" align="left" class="labelFactura">
                                <b>  <?= Yii::t('main','SellerAddress')?></b>
                            </td>
                            <td width="25%" align="left">
                                <?= $model->SellerAddress ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="25%" align="left" class="labelFactura">
                                <b>  <?= Yii::t('main','SellerTin')?></b>
                            </td>
                            <td width="25%" align="left">
                                <?= $model->SellerTin ?>
                            </td>

                        </tr>
                        <tr>
                            <td width="25%" align="left" class="labelFactura">
                                <b>   <?= Yii::t('main','SellerVatRegCode')?></b>

                            </td>
                            <td width="25%" align="left">
                                <?= $model->SellerVatRegCode ?>
                            </td>

                        </tr>
                    </table>
                </td>
                <td width="50%" align="center">
                    <table width="100%" style="font-size: 10px">
                        <tr>

                            <td width="25%" align="left" class="labelFactura">
                                <b>  <?= Yii::t('main','BuyerName')?></b>
                            </td>
                            <td width="25%" align="left">
                                <?= $model->BuyerName ?>
                            </td>
                        </tr>
                        <tr>

                            <td width="25%" align="left" class="labelFactura">
                                <b>  <?= Yii::t('main','BuyerAddress')?></b>
                            </td>
                            <td width="25%" align="left">
                                <?= $model->BuyerAddress ?>
                            </td>
                        </tr>
                        <tr>

                            <td width="25%" align="left" class="labelFactura">
                                <b>  <?= Yii::t('main','BuyerTin')?></b>
                            </td>
                            <td width="25%" align="left">
                                <?= $model->BuyerTin ?>
                            </td>
                        </tr>
                        <tr>

                            <td width="25%" align="left" class="labelFactura">
                                <b>     <?= Yii::t('main','BuyerVatRegCode')?></b>
                            </td>
                            <td width="25%" align="left">
                                <?= $model->BuyerVatRegCode ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
    </div>

        <table class="table table-bordered factura-grid" style="font-size: 8px;border-color: black;">

            <?php if($model->HasExcise==1){ ?>
                <?= $this->render('_pdfFuelItems', [
                    'products' => $products,
                    'measure'=>$measure

                ]) ?>

            <?php } else {?>
                <?= $this->render('_pdfItems', [
                    'products' => $products,
                    'measure'=>$measure

                ]) ?>

            <?php }?>
        </table>
        <table width="100%" style="font-size: 11px">
            <tr>
                <td width="50%">
                    <div><b><?= Yii::t('main','Руководитель')?>  </b>  <span><?= $model->SellerDirector?></span> </div>
                    <div><b><?= Yii::t('main','Главный бухгалтер:')?>    </b><span><?= $model->SellerAccountant ?></span> </div>
                    <div><b><?= Yii::t('main','Товар отпустил:')?>    </b><span><?= $model->ItemReleasedFio ?></span> </div>
                </td>
                <td width="50%" align="right">
                    <div><b><?= Yii::t('main','Руководитель')?>  </b>  <span><?= $model->BuyerDirector?></span> </div>
                    <div><b><?= Yii::t('main','Главный бухгалтер:')?>    </b><span><?= $model->BuyerAccountant?></span> </div>

                </td>
            </tr>

        </table>
    </div>
</div>
