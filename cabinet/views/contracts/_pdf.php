<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-08
 * Time: 23:56
 */
use Da\QrCode\QrCode;
/* @var $model \common\models\Contracts */
/* @var $products \common\models\ContractProducts */
$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name');

$qrCode = (new QrCode('{INN:'.\cabinet\models\Components::CompanyData('tin').', ContractIOd: '.$model->Id.' }'))
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
<div id="contracts">
    <div style="text-align: center;font-weight: bold;font-size: 14px;color: black">
         <table style="width:100%">
             <tr>
                 <td width="33%">

                 </td>
                 <td width="33%" align="center" style="font-weight:bold;font-size:14px;">
                     <?= $model->ContractName ?>
                     <p>Шартнома № <b><?= $model->ContractNo ?> </b></p>
                 </td>
                 <td width="33%" align="right">
                     <img src="<?= $qrCode->writeDataUri()?>">
                 </td>
             </tr>
         </table>






    </div>
    <div style="padding-top:20px">
        <table width="100%">
            <tr>
                 <td align="left">
                     <?= $model->ContractPlace ?>
                 </td>
                <td>

                </td>
                <td align="right">
                    <?= date('d.m.Y',strtotime($model->ContractDate)) ?>
                </td>

            </tr>
            <tr>
                <td>
                    (шартнома тузиш жойи)
                </td>
                <td>

                </td>
                <td align="right">
                    (шартнома тузиш санаси)

                </td>

            </tr>

        </table>
    </div>
<?php
$clients = \common\models\ContractClients::findAll(['contract_id'=>$model->Id]);
$client_name = "";
$directCliengt = "";
foreach ($clients as $itemCl){
    $client_name.=" <b>". $itemCl->Name."</b> (бундан буён – “Буюртмачи” деб аталади) номидан ҳаракат қилувчи директор <b>".$itemCl->Fio."</b>, ";

}
?>
    <p class="paragraph">
        <?= $model->Name ?> (бундан буён - “Бажарувчи” деб аталади) номидан ҳаракат қилувчи директор <b><?= $model->Fio ?></b>, бир томондан, ва <?= $client_name?>  иккинчи томондан, биргаликда “Тарафлар”, алоҳида эса “Тараф” деб аталувчилар мазкур шартномани қуйидагилар ҳақида туздилар:


    </p>

<?php $partsModel = \common\models\ContractParts::find()->andWhere(['contract_id'=>$model->Id])->orderBy('OrdNo ASC')->all(); ?>

        <?php $n=0; foreach ($partsModel as $itemsParts){  $n++;?>

         <?php if($n==1){ ?>
                <div style="font-weight: bold;text-align: center"> <?= $n.".".$itemsParts->Title ?> </div>
                <p>Ушбу шартномага биноан, Мижоз тўлайди ва қабул қилади ва Ижрочи қуйидаги шартлар асосида товарларни (хизматларни) етказиб беради:
                </p>
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

                <?php $total_sum =0; foreach ($products as $items){
                    $total_sum +=$items->DeliverySum;
                    ?>
                    <tr>
                        <td><?= $items->OrdNo ?></td>
                        <td><?= $items->Name ?></td>
                        <td><?= $items->MeasureId ?></td>
                        <td><?= $items->Count ?></td>
                        <td><?= $items->Summa ?></td>
                        <td><?= $items->DeliverySum ?></td>
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
                Шартноманинг умумий миқдори: <?= number_format($total_sum,2)?>
            </td>
            </tr>

        </table>
                <p class="paragraph"><?= $itemsParts->Body?></p>
             <?php } else {?>
            <div style="font-weight: bold;text-align: center"> <?= $n.".".$itemsParts->Title ?> </div>
            <p class="paragraph"><?= $itemsParts->Body?></p>

        <?php }}?>






        <table width="100%" style="font-size: 11px;padding-top: 30px">
            <tr>
                <td><b>ИЖРОЧИ</b></td>
                <td></td>
                <td><b>БУЮРТМАЧИ</b></td>
            </tr>
            <tr>
                <td>
                    <p>Номи: <?= $model->Name?></p>
                    <p>Манзили: <?= $model->Address?></p>
                    <p>Тел: <?= $model->WorkPhone?></p>
                    <p>Факс: <?= $model->Fax?></p>
                    <p>СТИР: <?= $model->Tin?></p>
                    <p>ОКЭД: <?= $model->Oked?></p>
                    <p>Ҳ/Р: <?= $model->Account?></p>
                    <p>Банк: <?= \cabinet\models\Components::getBankName($model->BankId) ?></p>
                    <p>МФО: <?= $model->BankId?></p>
                </td>
                <td></td>
                <td>
                    <?php foreach ($clients as $itemsClinet){ ?>
                    <div>
                        <p>Номи: <?= $itemsClinet->Name?></p>
                        <p>Манзили: <?= $itemsClinet->Address?></p>
                        <p>Тел: <?= $itemsClinet->WorkPhone?></p>
                        <p>Факс: <?= $itemsClinet->Fax?></p>
                        <p>СТИР: <?= $itemsClinet->Tin?></p>
                        <p>ОКЭД: <?= $itemsClinet->Oked?></p>
                        <p>Ҳ/Р: <?= $itemsClinet->Account?></p>
                        <p>Банк: <?= \cabinet\models\Components::getBankName($itemsClinet->BankId) ?></p>
                        <p>МФО: <?= $itemsClinet->BankId?></p>
                    </div>
                    <?php }?>
                </td>
            </tr>

        </table>
    </div>
</div>
</div>