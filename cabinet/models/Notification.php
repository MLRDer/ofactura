<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $factura_id
 * @property int $buyer_tin
 * @property int $seller_tin
 * @property int $aget_tin
 * @property int $type
 * @property string $created_at
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['factura_id', 'buyer_tin', 'seller_tin', 'type'], 'required'],
            [['buyer_tin', 'seller_tin', 'aget_tin', 'type'], 'integer'],
            [['created_at'], 'safe'],
            [['factura_id'], 'string', 'max' => 500],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'factura_id' => 'Factura ID',
            'buyer_tin' => 'Buyer Tin',
            'seller_tin' => 'Seller Tin',
            'aget_tin' => 'Aget Tin',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }
}
