<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "billing_main".
 *
 * @property int $id
 * @property int|null $invoices_id
 * @property int|null $company_id
 * @property string|null $created_date
 * @property int|null $all_sum
 * @property int|null $saldo_sum
 * @property int|null $satus
 * @property int|null $enabled
 */
class BillingMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'billing_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoices_id', 'company_id', 'all_sum', 'saldo_sum', 'satus', 'enabled'], 'integer'],
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
            'invoices_id' => 'Invoices ID',
            'company_id' => 'Company ID',
            'created_date' => 'Created Date',
            'all_sum' => 'All Sum',
            'saldo_sum' => 'Saldo Sum',
            'satus' => 'Satus',
            'enabled' => 'Enabled',
        ];
    }
}
