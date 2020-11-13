<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc_in_data_log".
 *
 * @property int $id
 * @property int|null $doc_data_id
 * @property int|null $success_type
 * @property int|null $reason_msg
 * @property string|null $created_date
 * @property int|null $status
 * @property int|null $enabled
 */
class DocInDataLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_in_data_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_data_id', 'success_type', 'status', 'enabled'], 'integer'],
            [['reason_msg'],'string'],
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
            'doc_data_id' => 'Doc Data ID',
            'success_type' => 'Success Type',
            'reason_msg' => 'Reason Msg',
            'created_date' => 'Created Date',
            'status' => 'Status',
            'enabled' => 'Enabled',
        ];
    }
}
