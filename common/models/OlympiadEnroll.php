<?php

namespace common\models;

use common\components\ActiveRecordCustom;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "olympiad_enroll".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property int $region_id
 * @property int $sub_region_id
 * @property int $school_number
 * @property int $class_number
 * @property string $class_letter
 * @property int $category_olympiad_id
 * @property int $olympiad_id
 * @property int $payed
 * @property int $payed_sum
 * @property string $transaction_id
 * @property int $transaction_time
 * @property int $transaction_time_own
 * @property int $transaction_perfom_time
 * @property string $created_at
 * @property string $updatyed_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 *
 * @property CategoryOlympiad $categoryOlympiad
 * @property User $createdBy
 * @property Olympiad $olympiad
 * @property Olympiad $olympiadActive
 * @property Region $region
 * @property string $regionName
 * @property SubRegion $subRegion
 * @property User $updatedBy
 * @property OlympiadMember[] $olympiadMembers
 * @property string $payedName
 */
class OlympiadEnroll extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const PAID_NO = 0;
    const PAID_YES = 1;

    public $members = '';

    public static function tableName()
    {
        return 'olympiad_enroll';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone', 'region_id', 'sub_region_id', 'school_number', 'class_number', 'class_letter', 'category_olympiad_id', 'olympiad_id', 'created_by', 'updated_by', 'payed'], 'required'],
            [['region_id', 'sub_region_id', 'school_number', 'class_number', 'category_olympiad_id', 'olympiad_id', 'created_by', 'updated_by', 'status', 'payed', 'payed_sum', 'transaction_time','transaction_time_own', 'transaction_perfom_time'], 'integer'],
            [['created_at', 'updatyed_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 32],
            [['transaction_id'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 14],
            [['class_letter'], 'string', 'max' => 3],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'first_name' => Yii::t('main', 'First Name'),
            'last_name' => Yii::t('main', 'Last Name'),
            'phone' => Yii::t('main', 'Phone'),
            'region_id' => Yii::t('main', 'Region ID'),
            'sub_region_id' => Yii::t('main', 'Sub Region ID'),
            'school_number' => Yii::t('main', 'School Number'),
            'class_number' => Yii::t('main', 'Class Number'),
            'class_letter' => Yii::t('main', 'Class Letter'),
            'category_olympiad_id' => Yii::t('main', 'Category Olympiad ID'),
            'olympiad_id' => Yii::t('main', 'Olympiad ID'),
            'payed' => Yii::t('main', 'Is Payed'),
            'payed_sum' => Yii::t('main', 'Payed sum'),
            'transaction_id' => Yii::t('main', 'Transaction ID'),
            'transaction_time' => Yii::t('main', 'Transaction time'),
            'transaction_time_own' => Yii::t('main', 'Transaction time our'),
            'transaction_perfom_time' => Yii::t('main', 'Transaction perform time'),
            'created_at' => Yii::t('main', 'Created At'),
            'updatyed_at' => Yii::t('main', 'Updatyed At'),
            'created_by' => Yii::t('main', 'Created By'),
            'updated_by' => Yii::t('main', 'Updated By'),
            'status' => Yii::t('main', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

}
