<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "manual_pay_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $client_ip
 * @property string $created_date
 * @property int $pay_sum
 * @property int $company_id
 * @property string $descriptions
 * @property int|null $type
 * @property int|null $enabled
 */
class ManualPayLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manual_pay_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'client_ip', 'created_date', 'pay_sum', 'company_id', 'descriptions'], 'required'],
            [['user_id', 'pay_sum', 'company_id', 'type', 'enabled'], 'integer'],
            [['created_date'], 'safe'],
            [['client_ip'], 'string', 'max' => 50],
            [['descriptions'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'client_ip' => 'Client Ip',
            'created_date' => 'Created Date',
            'pay_sum' => 'Pay Sum',
            'company_id' => 'Company ID',
            'descriptions' => 'Descriptions',
            'type' => 'Type',
            'enabled' => 'Enabled',
        ];
    }
}
