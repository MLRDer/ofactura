<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_docs".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $contract_number
 * @property string $number_docs
 * @property string $name
 * @property int|null $company_from_id
 * @property int|null $company_to_id
 * @property int|null $status
 * @property string|null $created_date
 * @property string|null $accept_date
 */
class CompanyDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'contract_number', 'company_from_id', 'company_to_id', 'status'], 'integer'],
            [['number_docs', 'name'], 'required'],
            [['created_date', 'accept_date'], 'safe'],
            [['number_docs'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
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
            'contract_number' => 'Contract Number',
            'number_docs' => 'Number Docs',
            'name' => 'Name',
            'company_from_id' => 'Company From ID',
            'company_to_id' => 'Company To ID',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'accept_date' => 'Accept Date',
        ];
    }
}
