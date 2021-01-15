<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "billing_items".
 *
 * @property int $id
 * @property int|null $billing_main_id
 * @property int|null $company_id
 * @property int $type_pay
 * @property int $values
 * @property int $invoices_type
 * @property int $saldo_sum
 * @property int|null $status
 * @property string|null $created_date
 */
class BillingItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'billing_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['billing_main_id', 'company_id', 'type_pay', 'values', 'invoices_type', 'saldo_sum', 'status'], 'integer'],
            [['type_pay', 'values', 'invoices_type', 'saldo_sum'], 'required'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'billing_main_id' => 'Billing Main ID',
            'company_id' => 'Company ID',
            'type_pay' => 'Type Pay',
            'values' => 'Values',
            'invoices_type' => 'Invoices Type',
            'saldo_sum' => 'Saldo Sum',
            'status' => 'Status',
            'created_date' => 'Created Date',
        ];
    }
}
