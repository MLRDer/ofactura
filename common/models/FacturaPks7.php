<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "factura_pks7".
 *
 * @property int $id
 * @property string $factura_id
 * @property string|null $seller_pks7
 * @property string|null $buyer_pks7
 */
class FacturaPks7 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factura_pks7';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['factura_id'], 'required'],
            [['factura_id'], 'string'],
            [['seller_pks7', 'buyer_pks7'], 'string'],
        ];
    }

    /**0
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'factura_id' => 'Factura ID',
            'seller_pks7' => 'Seller Pks7',
            'buyer_pks7' => 'Buyer Pks7',
        ];
    }
}
