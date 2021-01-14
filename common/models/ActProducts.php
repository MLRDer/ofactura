<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "act_products".
 *
 * @property int $Id
 * @property string $act_id
 * @property int $OrdNo
 * @property string $Name
 * @property string $MeasureId
 * @property float $Count
 * @property float $Summa
 * @property float $TotalSum
 */
class ActProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'act_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['act_id', 'OrdNo', 'Name', 'MeasureId', 'Count', 'Summa', 'TotalSum'], 'required'],
            [['OrdNo'], 'integer'],
            [['Count', 'Summa', 'TotalSum'], 'number'],
            [['act_id'], 'string', 'max' => 50],
            [['Name'], 'string', 'max' => 1000],
            [['MeasureId'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('main', 'ID'),
            'act_id' => Yii::t('main', 'Act ID'),
            'OrdNo' => Yii::t('main', 'Ord No'),
            'Name' => Yii::t('main', 'Name'),
            'MeasureId' => Yii::t('main', 'Measure ID'),
            'Count' => Yii::t('main', 'Count'),
            'Summa' => Yii::t('main', 'Summa'),
            'TotalSum' => Yii::t('main', 'Total Sum'),
        ];
    }
}
