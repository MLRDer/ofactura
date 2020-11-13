<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alco_category".
 *
 * @property int $id
 * @property string $name_uz
 * @property string|null $name_ru
 * @property int|null $sort_order
 */
class AlcoCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alco_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz'], 'required'],
            [['sort_order'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => 'Name Uz',
            'name_ru' => 'Name Ru',
            'sort_order' => 'Sort Order',
        ];
    }
}
