<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_invoices_helpers".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $name
 * @property string|null $mfo
 * @property string $invoices_number
 * @property string $address
 * @property int|null $status
 */
class CompanyInvoicesHelpers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_invoices_helpers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id',   'status'], 'integer'],
            [['name'], 'required'],
            [['invoices_number','mfo', 'address','name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'mfo' => 'Mfo',
            'invoices_number' => 'Invoices Number',
            'address' => 'Address',
            'status' => 'Status',
        ];
    }
}
