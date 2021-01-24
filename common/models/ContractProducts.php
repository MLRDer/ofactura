<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contract_products".
 *
 * @property int $id
 * @property string $contract_id
 * @property string $OrdNo
 * @property string|null $BarCode
 * @property string|null $CatalogCode
 * @property string|null $CatalogName
 * @property string $Name
 * @property string $MeasureId
 * @property float $Count
 * @property float $Summa
 * @property float $DeliverySum
 * @property float|null $VatRate
 * @property float|null $VatSum
 * @property float|null $DeliverySumWithVat
 * @property int|null $WithoutVat
 */
class ContractProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contract_id', 'OrdNo', 'Name', 'MeasureId', 'Count', 'Summa', 'DeliverySum'], 'required'],
            [['Count', 'Summa', 'DeliverySum', 'VatRate', 'VatSum', 'DeliverySumWithVat'], 'number'],
            [['WithoutVat'], 'integer'],
            [['contract_id', 'OrdNo', 'BarCode', 'CatalogCode', 'MeasureId'], 'string', 'max' => 50],
            [['CatalogName', 'Name'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'contract_id' => Yii::t('main', 'Contract ID'),
            'OrdNo' => Yii::t('main', 'Ord No'),
            'BarCode' => Yii::t('main', 'Bar Code'),
            'CatalogCode' => Yii::t('main', 'Catalog Code'),
            'CatalogName' => Yii::t('main', 'Catalog Name'),
            'Name' => Yii::t('main', 'Name'),
            'MeasureId' => Yii::t('main', 'Measure ID'),
            'Count' => Yii::t('main', 'Count'),
            'Summa' => Yii::t('main', 'Summa'),
            'DeliverySum' => Yii::t('main', 'Delivery Sum'),
            'VatRate' => Yii::t('main', 'Vat Rate'),
            'VatSum' => Yii::t('main', 'Vat Sum'),
            'DeliverySumWithVat' => Yii::t('main', 'Delivery Sum With Vat'),
            'WithoutVat' => Yii::t('main', 'Without Vat'),
        ];
    }
}
