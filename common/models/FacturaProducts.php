<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "factura_products".
 *
 * @property int $id
 * @property string $FacturaId
 * @property string $OrdNo Порядковый номер
 * @property string|null $CommittentName Наименование комитента
 * @property string|null $CommittentTin ИНН комитента
 * @property string|null $CommittentVatRegCode Регистрационный код плательщика НДС комитента
 * @property string $Name Наименование товара (продукта, услуги)
 * @property string|null $Serial Серия товара
 * @property int $MeasureId ID единицы измерения
 * @property float|null $BaseSumma Базовая цена
 * @property float|null $ProfitRate % добавочной стоимости
 * @property float $Count Количество
 * @property float $Summa Цена
 * @property float|null $ExciseRate Ставка акцизного налога
 * @property float|null $ExciseSum Сумма акцизного налога
 * @property float $DeliverySum Стоимость поставки
 * @property float $VatRate Ставка НДС
 * @property float $VatSum Сумма НДС
 * @property float $DeliverySumWithVat Стоимость поставки с учётом НДС
 * @property int $WithoutVat Без НДС
 */
class FacturaProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factura_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FacturaId', 'OrdNo', 'Name', 'MeasureId', 'Count', 'Summa', 'DeliverySum', 'VatRate', 'VatSum', 'DeliverySumWithVat'], 'required'],
            [['MeasureId','WithoutVat'], 'integer'],
            [['BaseSumma', 'ProfitRate', 'Count', 'Summa', 'ExciseRate', 'ExciseSum', 'DeliverySum', 'VatRate', 'VatSum', 'DeliverySumWithVat'], 'number'],
            [['FacturaId'], 'string', 'max' => 24],
            [['OrdNo'], 'string', 'max' => 5],
            [['CommittentName', 'Serial'], 'string', 'max' => 500],
            [['CommittentTin'], 'string', 'max' => 9],
            [['CommittentVatRegCode'], 'string', 'max' => 12],
            [['Name'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'FacturaId' => Yii::t('main', 'Factura ID'),
            'OrdNo' => Yii::t('main', 'Порядковый номер'),
            'CommittentName' => Yii::t('main', 'Наименование комитента'),
            'CommittentTin' => Yii::t('main', 'ИНН комитента'),
            'CommittentVatRegCode' => Yii::t('main', 'Регистрационный код плательщика НДС комитента'),
            'Name' => Yii::t('main', 'Наименование товара (продукта, услуги)'),
            'Serial' => Yii::t('main', 'Серия товара'),
            'MeasureId' => Yii::t('main', 'ID единицы измерения'),
            'BaseSumma' => Yii::t('main', 'Базовая цена'),
            'ProfitRate' => Yii::t('main', '% добавочной стоимости'),
            'Count' => Yii::t('main', 'Количество'),
            'Summa' => Yii::t('main', 'Цена'),
            'ExciseRate' => Yii::t('main', 'Ставка акцизного налога'),
            'ExciseSum' => Yii::t('main', 'Сумма акцизного налога'),
            'DeliverySum' => Yii::t('main', 'Стоимость поставки'),
            'VatRate' => Yii::t('main', 'Ставка НДС'),
            'VatSum' => Yii::t('main', 'Сумма НДС'),
            'DeliverySumWithVat' => Yii::t('main', 'Стоимость поставки с учётом НДС'),
            'WithoutVat' => Yii::t('main', 'Без НДС'),
        ];
    }
}
