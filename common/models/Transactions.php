<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property int $enroll_id
 * @property string $transaction_id
 * @property int $transaction_time
 * @property int $transaction_time_own
 * @property int $transaction_perform_time
 * @property int $transaction_cancel_time
 * @property int $amount
 * @property int $state
 * @property int $reason
 *
// * @property OlympiadEnroll $enroll
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const STATE_NEW = 1;
    const STATE_PAID = 2;
    const STATE_CANCELLED = -1;
    const STATE_CANCELLED_2 = -2;


    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enroll_id', 'transaction_id'], 'required'],
            [['enroll_id', 'transaction_time', 'transaction_time_own', 'transaction_perform_time', 'amount', 'state', 'transaction_cancel_time','reason'], 'integer'],
            [['transaction_id'], 'string', 'max' => 64],
            [['transaction_id'], 'unique'],
            [['enroll_id'], 'exist', 'skipOnError' => true, 'targetClass' => OlympiadEnroll::className(), 'targetAttribute' => ['enroll_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'enroll_id' => Yii::t('main', 'Enroll ID'),
            'transaction_id' => Yii::t('main', 'Transaction ID'),
            'transaction_time' => Yii::t('main', 'Transaction Time'),
            'transaction_time_own' => Yii::t('main', 'Transaction Time Own'),
            'transaction_perform_time' => Yii::t('main', 'Transaction Perform Time'),
            'transaction_cancel_time' => Yii::t('main', 'Transaction Cancel Time'),
            'amount' => Yii::t('main', 'Amount'),
            'state' => Yii::t('main', 'State'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getEnroll()
//    {
//        return $this->hasOne(OlympiadEnroll::className(), ['id' => 'enroll_id']);
//    }
}
