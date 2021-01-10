<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "empowerment_in_data".
 *
 * @property int $id
 * @property string|null $emp_data
 * @property string|null $reason
 * @property string|null $agent_tin
 * @property string $created_date
 * @property int $type
 * @property int $enabled
 */
class EmpowermentInData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empowerment_in_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_date', 'type', 'enabled'], 'required'],
            [['emp_data','agent_tin'], 'string'],
            [['created_date'], 'safe'],
            [['type', 'enabled'], 'integer'],
            [['reason'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_data' => 'Emp Data',
            'reason' => 'Reason',
            'created_date' => 'Created Date',
            'type' => 'Type',
            'enabled' => 'Enabled',
        ];
    }
}
