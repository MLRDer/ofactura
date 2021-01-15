<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_tarif_log".
 *
 * @property int $id
 * @property int $company_id
 * @property int $tarif_id
 * @property string|null $created_date
 * @property string|null $change_date
 * @property int|null $send_value
 * @property int|null $remain_value
 * @property int|null $status
 * @property int|null $enabled
 */
class CompanyTarifLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_tarif_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'tarif_id'], 'required'],
            [['company_id', 'tarif_id', 'send_value', 'remain_value', 'status', 'enabled'], 'integer'],
            [['created_date', 'change_date'], 'safe'],
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
            'tarif_id' => 'Tarif ID',
            'created_date' => 'Created Date',
            'change_date' => 'Change Date',
            'send_value' => 'Send Value',
            'remain_value' => 'Remain Value',
            'status' => 'Status',
            'enabled' => 'Enabled',
        ];
    }
}
