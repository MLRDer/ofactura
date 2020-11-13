<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoices_log".
 *
 * @property int $id
 * @property int|null $succes_type
 * @property string|null $reason
 * @property string|null $created_date
 * @property int|null $status
 * @property int|null $enabled
 */
class InvoicesLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['succes_type', 'status', 'enabled'], 'integer'],
            [['created_date'], 'safe'],
            [['reason'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'succes_type' => 'Succes Type',
            'reason' => 'Reason',
            'created_date' => 'Created Date',
            'status' => 'Status',
            'enabled' => 'Enabled',
        ];
    }
}
