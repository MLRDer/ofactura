<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc_products".
 *
 * @property int $id
 * @property int $company_id
 * @property int $doc_id
 * @property int|null $SortOreder
 * @property string $ProductName
 * @property int|null $ProductMeasureId
 * @property int $ProductCount
 * @property int $ProductSumma
 * @property int $ProductDeliverySum
 * @property string $ProductVatRate
 * @property string $ProductVatSum
 * @property string $ProductDeliverySumWithVat
 * @property string $ProductFuelRate
 * @property string $ProductFuelSum
 * @property string $ProductDeliverySumWithFuel
 * @property string $created_date
 * @property string $status
 * @property string $enabled
 */
class DocProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'doc_id', 'ProductName', 'ProductCount', 'ProductSumma', 'ProductDeliverySum'], 'required'],
            [['company_id', 'doc_id', 'SortOreder', 'created_date', 'status', 'enabled'], 'integer'],
            [['ProductName'], 'string', 'max' => 255],
            [['ProductMeasureId', 'ProductCount', 'ProductSumma', 'ProductDeliverySum', 'ProductVatRate', 'ProductVatSum', 'ProductDeliverySumWithVat', 'ProductFuelRate', 'ProductFuelSum', 'ProductDeliverySumWithFuel'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'doc_id' => 'Doc ID',
            'SortOreder' => 'Sort Oreder',
            'ProductName' => 'Product Name',
            'ProductMeasureId' => 'Product Measure ID',
            'ProductCount' => 'Product Count',
            'ProductSumma' => 'Product Summa',
            'ProductDeliverySum' => 'Product Delivery Sum',
            'ProductVatRate' => 'Product Vat Rate',
            'ProductVatSum' => 'Product Vat Sum',
            'ProductDeliverySumWithVat' => 'Product Delivery Sum With Vat',
            'ProductFuelRate' => 'Product Fuel Rate',
            'ProductFuelSum' => 'Product Fuel Sum',
            'ProductDeliverySumWithFuel' => 'Product Delivery Sum With Fuel',
            'created_date' => 'Created Date',
            'status' => 'Status',
            'enabled' => 'Enabled',
        ];
    }
}
