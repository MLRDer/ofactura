<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_docs_items".
 *
 * @property int $id
 * @property int $company_id
 * @property int $docs_id
 * @property string $name
 * @property int|null $pay_type
 * @property int|null $count
 * @property int|null $price
 * @property int|null $price_all
 * @property int|null $tax_id
 */
class CompanyDocsItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_docs_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'docs_id', 'name'], 'required'],
            [['company_id', 'docs_id', 'pay_type', 'count', 'price', 'price_all', 'tax_id'], 'integer'],
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
            'docs_id' => 'Docs ID',
            'name' => 'Name',
            'pay_type' => 'Pay Type',
            'count' => 'Count',
            'price' => 'Price',
            'price_all' => 'Price All',
            'tax_id' => 'Tax ID',
        ];
    }
}
