<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "empowerment_product".
 *
 * @property int $id
 * @property int $company_id
 * @property int $empowerment_id
 * @property string $Name
 * @property int $MeasureId
 * @property float $Count
 * @property int|null $enabled
 */
class EmpowermentProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empowerment_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'empowerment_id', 'Name', 'MeasureId', 'Count'], 'required'],
            [['company_id', 'empowerment_id', 'MeasureId', 'enabled'], 'integer'],
            [['Count'],'number'],
            [['Name'], 'string', 'max' => 255],
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
            'empowerment_id' => 'Empowerment ID',
            'Name' => 'Name',
            'MeasureId' => 'Measure ID',
            'Count' => 'Count',
            'enabled' => 'Enabled',
        ];
    }
}
