<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_tarif".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property int $period
 * @property int $value_doc
 * @property int $month_mony
 * @property int $price
 * @property int|null $status
 * @property int|null $type
 * @property int|null $enabled
 */
class CompanyTarif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_tarif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'period', 'value_doc', 'month_mony', 'price'], 'required'],
            [['period', 'value_doc', 'month_mony', 'price', 'status', 'type', 'enabled'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'period' => 'Amal qilish davri',
            'value_doc' => 'Xujjatlar soni',
            'month_mony' => 'Oylik to`lov',
            'price' => 'Narxi',
            'status' => 'Xolati',
            'type' => 'Tip',
            'enabled' => 'Faol',
        ];
    }
}
