<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-01-02
 * Time: 21:49
 */

$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name');
$data = \common\models\ContractProducts::find()->andWhere(['contract_id'=>$model->Id])->orderBy('OrdNo ASC')->all();
$k=0;
?>

<input type="hidden" id="row_value" value="2">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th width="40px"></th>
            <th><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
            <th width="199px"><?= Yii::t('main','Товар (хизмат)лар Ягона электрон миллий каталоги бўйича идентификация коди ва номи')?></th>
            <th width="112px" ><?= Yii::t('main','Товар штрих коди (мажбурий эмас)')?></th>
            <th width="112px"><?= Yii::t('main','Ед. изм.')?></th>
            <th width="112px" ><?= Yii::t('main','Кол - во')?></th>
            <th width="112px"><?= Yii::t('main','Цена за единицу')?></th>
            <th width="112px"><?= Yii::t('main','Стоимость поставки')?></th>
        </tr>
        </thead>
        <tbody id="productItemsArea">

        <?php if($model->isNewRecord || empty($data)){ ?>
            <tr rowid="1">
                <td align="center">

                    <label class="second-checkbox d-inline-block m-t-5">
                        <input rowid="1" type="checkbox" name="record">
                        <div class="square"></div>
                    </label>

                </td>

                <td>
                    <div class="editable" name="ProductName" rowid="1"></div>
                </td>
                <td>
                    <div class="editable" name="ProductCatalogName" rowid="1"></div>
                </td>
                <td>
                    <div class="editable" name="ProductCatalogCode" rowid="1"></div>
                </td>
                <td>
                    <div class="editable" name="ProductMeasureId" rowid="1"></div>
                </td>
                <td>
                    <div class="editable" name="ProductCount" id="ProductCount_1" rowid="1"></div>
                </td>
                <td>
                    <div class="editable" name="ProductSumma" id="ProductSumma_1" rowid="1"></div>
                </td>
                <td>
                    <div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_1" rowid="1"></div>
                </td>
            </tr>
        <?php } else {
            $countAll =0;
            $sumAll =0;
            $vatAll =0;
            $sumvatAll =0;
            foreach  ($data as $items){ $k++;
                $countAll+=$items->Count;
                $sumAll +=$items->DeliverySum;
                $vatAll +=$items->VatSum;
                $sumvatAll +=$items->DeliverySumWithVat;

//                var_dump($items);
//                die();
                ?>
                <tr rowid="<?= $items->OrdNo ?>">
                    <td align="center">

                        <label class="second-checkbox d-inline-block m-t-5">
                            <input rowid="<?= $items->OrdNo ?>" type="checkbox" name="record">
                            <div class="square"></div>
                        </label>

                    </td>

                    <td>
                        <div class="editable" name="ProductName" rowid="<?= $items->OrdNo ?>"><?= $items->Name ?></div>
                    </td>

                    <td>
                        <div class="editable" name="ProductCatalogName" rowid="<?= $items->OrdNo ?>"><?= $items->CatalogName ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductCatalogCode" rowid="<?= $items->OrdNo ?>"><?= $items->CatalogCode ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductMeasureId" rowid="<?= $items->OrdNo ?>">
                            <?= $measure[$items->MeasureId]?>
                        </div>
                    </td>
                    <td>
                        <div class="editable" name="ProductCount" id="ProductCount_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->Count ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductSumma" id="ProductSumma_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->Summa ?></div>
                    </td>

                    <td>
                        <div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->DeliverySum ?></div>
                    </td>
                </tr>

            <?php } ?>

        <?php }?>

        </tbody>
    </table>

    <div>
        <input type="hidden" id="row_value" value="<?= ($model->isNewRecord)?2:$k+1 ?>">


    </div>



<div class="footer">
    <div type="button" class="add-row btn-outline-blue color-blue standard-btn m-r-20">
        + <?= Yii::t('main','Добавить ещё')?>
    </div>
    <button type="button" class="delete-row btn-red">
        <?= Yii::t('main','Удалить')?>
    </button>

</div>









