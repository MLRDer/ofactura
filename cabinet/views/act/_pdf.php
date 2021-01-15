<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-08
 * Time: 23:56
 */
use Da\QrCode\QrCode;
/* @var $model \common\models\Acts */
/* @var $products \common\models\ActProducts */
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
                 <td width="33%">

                 </td>
                 <td width="33%" align="center" style="font-weight:bold;font-size:14px;">
                     <?= Yii::t('main','БАЖАРИЛГАН ИШЛАР (КЎРСАТИЛГАН ХИЗМАТЛАР) ЮЗАСИДАН
ҚАБУЛ-ҚИЛИШ ВА ТОПШИРИШ ДАЛОЛАТНОМАСИ') ?>
                 </td>
                 <td width="33%" align="right">
                     <img src="<?= $qrCode->writeDataUri()?>">
                 </td>

             </tr>
             <tR>
                 <td></td>
                 <td><?= Yii::t('main','Dalolatnoma № <b>{FacturaNo}</b>  Sanasi {FacturaDate} <div><div> Shartnoma № <b>{ContractNo}</b> Sanasi {ContractDate} </div>',[
                         'FacturaNo'=>$model->ActNo,
                         'FacturaDate'=>date("d.m.Y",strtotime($model->ActDate)),
                         'ContractNo'=>$model->ContractNo,
                         'ContractDate'=>date("d.m.Y",strtotime($model->ContractDate)),
                     ])?></td>
                 <td></td>
             </tR>
         </table>






    </div>
    <div style="padding-top:20px">
        <table width="100%">
            <tr>
                 <td>
                     <?= $model->ActText ?>
                 </td>

            </tr>

        </table>
    </div>

        <table class="bordered w-100 mt-15px">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Иш (хизмат) номи	</th>
                        <th>Ўлчов бирлиги	</th>
                        <th>Миқдори</th>
                        <th>Нархи</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                </tr>
                <?php $total_sum =0; foreach ($products as $items){
                    $total_sum +=$items->TotalSum;
                    ?>
                    <tr>
                        <td><?= $items->OrdNo ?></td>
                        <td><?= $items->Name ?></td>
                        <td><?= $items->MeasureId ?></td>
                        <td><?= $items->Count ?></td>
                        <td><?= $items->Summa ?></td>
                        <td><?= $items->TotalSum ?></td>
                    </tr>
                <?php }?>
                    <tr>
                        <td colspan="5" align="right"><b>Jami</b></td>
                        <td><?= number_format($total_sum,2)?></td>
                    </tr>
            </tbody>

        </table>

        <table width="100%" style="font-size: 11px">
            <tr>
            <td>
                Томонларнинг бир-бирига нисбатан эътирози йўқ.<br>
                Далолатнома бўйича қабул қилинган ишнинг қиймати: <?= number_format($total_sum,2)?> .


            </td>
            </tr>

        </table>
        <table width="100%" style="font-size: 11px;padding-top: 30px">
            <tr>
                <td><b>Пудратчи:</b><?= $model->SellerName?></td>
                <td></td>
                <td><b>Буюртмачи:</b> <?= $model->BuyerName?></td>
            </tr>

        </table>
    </div>
</div>
