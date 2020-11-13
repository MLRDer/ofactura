<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "syns_jobs".
 *
 * @property int $id
 * @property string $tin
 * @property string|null $from_date
 * @property string|null $to_date
 * @property int|null $status
 * @property int|null $enabled
 */
class SynsJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'syns_jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tin'], 'required'],
            [['from_date', 'to_date'], 'safe'],
            [['status', 'enabled'], 'integer'],
            [['tin'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tin' => 'Tin',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'status' => 'Status',
            'enabled' => 'Enabled',
        ];
    }
}
