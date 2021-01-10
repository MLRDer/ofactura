<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "month_pay".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $value
 * @property string|null $created_date
 * @property string|null $end_date
 * @property int|null $enabled
 * @property int|null $tarif_id
 */
class MonthPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'month_pay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'value', 'enabled', 'tarif_id'], 'integer'],
            [['created_date', 'end_date'], 'safe'],
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
            'value' => 'Value',
            'created_date' => 'Created Date',
            'end_date' => 'End Date',
            'enabled' => 'Enabled',
            'tarif_id' => 'Tarif ID',
        ];
    }
}
