<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-01-02
 * Time: 21:49
 */

$measure = \common\models\DocMeasure::find()->all();
$measure = \yii\helpers\ArrayHelper::map($measure,'id','name')
?>

<table class="table table-bordered">
    <thead>

    <tr>
        <th width="40px" rowspan="2"></th>

        <th rowspan="2"><?= Yii::t('main','Наименование товара, выполненных работ и оказанных услуг')?></th>
        <th rowspan="2"><?= Yii::t('main','Товар (хизмат)лар Ягона электрон миллий каталоги бўйича идентификация коди ва номи')?></th>
        <th width="130px"  rowspan="2"><?= Yii::t('main','Товар штрих коди (мажбурий эмас)')?></th>
        <th width="130px" rowspan="2"><?= Yii::t('main','Ед. изм.')?></th>
        <th width="90px" rowspan="2"><?= Yii::t('main','Кол - во')?></th>
        <th width="130px" rowspan="2"><?= Yii::t('main','Цена за единицу')?></th>
        <th width="130px" rowspan="2"><?= Yii::t('main','Стоимость поставки')?></th>

        <th width="60px" colspan="2" rowspan="1"><?= Yii::t('main','AKSIS')?></th>
        <th width="130px"  rowspan="2"><?= Yii::t('main','Стоимость поставок с учётом AKSIS')?></th>


        <th width="60px" colspan="2" rowspan="1"><?= Yii::t('main','НДС')?></th>
        <th width="130px" rowspan="2"><?= Yii::t('main','Стоимость поставок с учётом НДС')?></th>

    </tr>
    <tr>
        <th width="130px" rowspan="1"><?= Yii::t('main','ставка %')?></th>
        <th width="130px" rowspan="1"><?= Yii::t('main','сумма')?></th>

        <th width="130px" rowspan="1"><?= Yii::t('main','ставка %')?></th>
        <th width="130px" rowspan="1"><?= Yii::t('main','сумма')?></th>
    </tr>

    </thead>
    <tbody id="productItemsArea">

    <?php if($model->isNewRecord){ ?>
        <tr>
            <td align="center">

                <label class="kt-checkbox kt-checkbox--brand">
                    <input type="checkbox" name="record">
                    <span style="top: 4px;left: 5px;"></span>
                </label>

            </td>

            <td>
                <div class="editable" focus name="ProductName" rowid="1"></div>
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
                <div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_1" rowid="1">0</div>
            </td>

            <td>
                <div class="editable" name="ProductFuelRate" id="ProductFuelRate_1" rowid="1">0</div>
            </td>
            <td>
                <div class="editable" name="ProductFuelSum" id="ProductFuelSum_1" rowid="1">0</div>
            </td>
            <td>
                <div class="editable" name="ProductDeliverySumWithFuel" id="ProductDeliverySumWithFuel_1" rowid="1">0</div>
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
        <tr>
            <td align="center" colspan="5">

0

            </td>
0
            <td>
0
            </td>
            <td>
0
            </td>
            <td>
0
            </td>

            <td>
0
            </td>
            <td>
0
            </td>
            <td>
0
            </td>

            <td>
0
            </td>
            <td>
0
            </td>

            <td>
0
            </td>


        </tr>

    <?php } else {  $data = \common\models\DocProducts::find()->andWhere(['company_id'=>\cabinet\models\Components::GetId(),'doc_id'=>$model->id])->orderBy('SortOreder ASC')->all();
        $k=0;
        foreach  ($data as $items){ $k++;
            ?>
            <tr>
                <td align="center">

                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="record">
                        <span style="top: 4px;left: 5px;"></span>
                    </label>

                </td>

                <td>
                    <div class="editable" onkeypress="keyPressHandler(e)" name="ProductName" rowid="<?= $items->SortOreder ?>"><?= $items->ProductName ?></div>
                </td>
                <td>
                    <div class="editable" name="ProductCatalogName" rowid="<?= $items->SortOreder ?>"><?= $items->ProductCatalogName ?></div>
                </td>
                <td>
                    <div class="editable" name="ProductCatalogCode" rowid="<?= $items->SortOreder ?>"><?= $items->ProductCatalogCode ?></div>
                </td>
                <td>
                    <div class="editable" name="ProductMeasureId" rowid="<?= $items->SortOreder ?>">
                        <?= $measure[$items->ProductMeasureId]?>
                    </div>
                </td>
                <td>
                    <div class="editable" name="ProductCount" id="ProductCount_<?= $items->SortOreder ?>" rowid="<?= $items->SortOreder ?>"><?= $items->ProductCount ?></div>
                </td>
                <td>
                    <div class="editable" name="ProductSumma" id="ProductSumma_<?= $items->SortOreder ?>" rowid="<?= $items->SortOreder ?>"><?= $items->ProductSumma ?></div>
                </td>
                <td>
                    <div class="editable" name="ProductDeliverySum" id="ProductDeliverySum_<?= $items->SortOreder ?>" rowid="<?= $items->SortOreder ?>"><?= $items->ProductDeliverySum ?></div>
                </td>


                <td>
                    <div class="editable" name="ProductFuelRate" id="ProductFuelRate_1" rowid="1">
                        <?= $items->ProductFuelRate ?>
                    </div>
                </td>
                <td>
                    <div class="editable" name="ProductFuelSum" id="ProductFuelSum_1" rowid="1">
                        <?= $items->ProductFuelSum ?>
                    </div>
                </td>
                <td>
                    <div class="editable" name="ProductDeliverySumWithFuel" id="ProductDeliverySumWithFuel_1" rowid="1">
                        <?= $items->ProductDeliverySumWithFuel ?>
                    </div>
                </td>

                <td>
                    <div class="editable" name="ProductVatRate" id="ProductVatRate_<?= $items->SortOreder ?>" rowid="<?= $items->SortOreder ?>"><?= $items->ProductVatRate ?></div>
                </td>
                <td>
                    <div class="editable" name="ProductVatSum" id="ProductVatSum_<?= $items->SortOreder ?>" rowid="<?= $items->SortOreder ?>"><?= $items->ProductVatSum ?></div>
                </td>
                <td>
                    <div class="editable" name="ProductDeliverySumWithVat" id="ProductDeliverySumWithVat_<?= $items->SortOreder ?>" rowid="<?= $items->SortOreder ?>"><?= $items->ProductDeliverySum ?></div>
                </td>


            </tr>

        <?php }}?>
    </tbody>
</table>

<div>
    <input type="hidden" id="row_value" value="<?= ($model->isNewRecord)?2:$k+1 ?>">


</div>

<script>
    function keyPressHandler(e){
        console.log(e.keyCode);if (e.keyCode==9||e.keyCode==13){document.getElementById('ProductCount_1').click()}
    }
</script>