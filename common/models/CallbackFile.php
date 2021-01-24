<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callback_file".
 *
 * @property int $id
 * @property string $created_date
 * @property int $type
 * @property string $path
 * @property int|null $status
 * @property string|null $reason
 * @property int|null $enabled
 * @property int|null $type_action
 */
class CallbackFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const TYPE_FACTURA =10;
    const TYPE_ACT =20;
    const TYPE_EMP =30;
    const TYPE_CONTRACT =40;

    const STATUS_NEW = 10;
    const STATUS_IMPORTED = 20;
    const STATUS_ERROR = 30;

    const ACTION_RECEIVED = 10;
    const ACTION_ACCEPT = 20;
    const ACTION_REJECT = 30;
    const ACTION_CANCELED = 40;



    public static function tableName()
    {
        return 'callback_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_date', 'type', 'path'], 'required'],
            [['created_date'], 'safe'],
            [['type', 'status', 'enabled', 'type_action'], 'integer'],
            [['path'], 'string', 'max' => 500],
            [['reason'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'created_date' => Yii::t('main', 'Created Date'),
            'type' => Yii::t('main', 'Type'),
            'path' => Yii::t('main', 'Path'),
            'status' => Yii::t('main', 'Status'),
            'reason' => Yii::t('main', 'Reason'),
            'enabled' => Yii::t('main', 'Enabled'),
            'type_action' => Yii::t('main', 'Type Action'),
        ];
    }
}
