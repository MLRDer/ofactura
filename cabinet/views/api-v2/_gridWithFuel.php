<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-01-02
 * Time: 21:49
 */

$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name');
$data = \common\models\FacturaProducts::find()->andWhere(['FacturaId'=>$model->Id])->orderBy('OrdNo ASC')->all();
$k=0;
?>

<input type="hidden" id="row_value" value="2">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th width="40px" rowspan="2"></th>
            <th rowspan="2"><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
            <th rowspan="2" width="199px"><?= Yii::t('main','Товар (хизмат)лар Ягона электрон миллий каталоги бўйича идентификация коди ва номи')?></th>
            <th width="112px"  rowspan="2"><?= Yii::t('main','Товар штрих коди (мажбурий эмас)')?></th>
            <th rowspan="2" width="112px"><?= Yii::t('main','Ед. изм.')?></th>
            <th width="112px" rowspan="2"><?= Yii::t('main','Кол - во')?></th>
            <th width="112px" rowspan="2"><?= Yii::t('main','Цена за единицу')?></th>

            <th width="112px" colspan="2" rowspan="1"><?= Yii::t('main','AKSIS')?></th>
            <th width="112px" rowspan="2"><?= Yii::t('main','Стоимость поставки')?></th>
            <th width="112px" colspan="2" rowspan="1"><?= Yii::t('main','НДС')?></th>
            <th width="112px" rowspan="2"><?= Yii::t('main','Стоимость поставок с учётом НДС')?></th>
        </tr>
        <tr>
            <th width="112px" rowspan="1"><?= Yii::t('main','ставка %')?></th>
            <th width="112px" rowspan="1"><?= Yii::t('main','сумма')?></th>

            <th width="112px" rowspan="1"><?= Yii::t('main','ставка %')?></th>
            <th width="112px" rowspan="1"><?= Yii::t('main','сумма')?></th>


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
                    <div class="editable" name="ProductCount" id="ProductCount_1" rowid="1">0</div>
                </td>
                <td>
                    <div class="editable" name="ProductSumma" id="ProductSumma_1" rowid="1">0</div>
                </td>
                <td>
                    <div class="editable" name="ProductFuelRate" id="ProductFuelRate_1" rowid="1">0</div>
                </td>
                <td>
                    <div class="editable" name="ProductFuelSum" id="ProductFuelSum_1" rowid="1">0</div>
                </td>
                <td>
                    <div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_1" rowid="1">0</div>
                </td>

                <td>
                    <div class="editable" name="ProductVatRate" id="ProductVatRate_1" rowid="1">0</div>
                </td>
                <td>
                    <div class="editable" name="ProductVatSum" id="ProductVatSum_1" rowid="1">0</div>
                </td>

                <td>
                    <div class="editable" name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVat_1" rowid="1">0</div>
                </td>
            </tr>
            <tr rowid="1">
                <td align="right" colspan="5">
                    <div style="padding-right:10px">
                        <b><?= Yii::t('main','Jami:')?></b>
                    </div>
                </td>
                <td>
                    <div  name="ProductCount" id="ProductCountAll">0</div>
                </td>
                <td>

                </td>
                <td>


                </td>
                <td>


                </td>
                <td>
                    <div  name="ProductDeliverySum" id="ProductDeliverySumAll">0</div>
                </td>

                <td>


                </td>
                <td>

                    <div  name="ProductVatSum" id="ProductVatSumAll">0</div>
                </td>

                <td>
                    <div name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVatAll">0</div>
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

                var_dump($items);
                die();
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
                        <div class="editable" name="ProductFuelRate" id="ProductFuelRate_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->ExciseRate ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductFuelSum" id="ProductFuelSum_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->ExciseSum ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->DeliverySum ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductVatRate" id="ProductVatRate_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->VatRate ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductVatSum" id="ProductVatSum_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->VatSum ?></div>
                    </td>
                    <td>
                        <div class="editable" name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVat_<?= $items->OrdNo ?>" rowid="<?= $items->OrdNo ?>"><?= $items->DeliverySumWithVat ?></div>
                    </td>

                </tr>

            <?php } ?>
            <tr rowid="1">
                <td align="right" colspan="5">
                    <div style="padding-right:10px">
                        <b><?= Yii::t('main','Jami:')?></b>
                    </div>
                </td>
                <td>
                    <div  name="ProductCount" id="ProductCountAll"><?= $countAll?></div>
                </td>
                <td>

                </td>
                <td>
                    <div  name="ProductDeliverySum" id="ProductDeliverySumAll"><?= $sumAll?></div>
                </td>
                <td>


                </td>
                <td>


                </td>
                <td>


                </td>
                <td>

                    <div  name="ProductVatSum" id="ProductVatSumAll"><?= $vatAll?></div>
                </td>

                <td>
                    <div name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVatAll"><?= $sumvatAll?></div>
                </td>


            </tr>
        <?php }?>

        </tbody>
    </table>

    <div>
        <input type="hidden" id="row_value" value="<?= ($model->isNewRecord)?2:$k+1 ?>">


    </div>



<div class="footer">
    <div type="button" class="add-row btn-outline-blue color-blue standard-btn m-r-20">
        <?= Yii::t('main','+ Добавить ещё')?>
    </div>
    <button type="button" class="delete-row btn-red">
        <?= Yii::t('main','Удалить')?>
    </button>

</div>









