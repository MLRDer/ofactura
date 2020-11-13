<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "web_services".
 *
 * @property int $id
 * @property string $name_uz
 * @property string|null $name_oz
 * @property string|null $name_ru
 * @property string|null $anons_uz
 * @property string|null $anons_oz
 * @property string|null $anons_ru
 * @property string|null $icon
 * @property int|null $sort_order
 * @property int|null $enabled
 */
class WebServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'web_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz'], 'required'],
            [['sort_order', 'enabled'], 'integer'],
            [['name_uz', 'name_oz', 'name_ru', 'icon'], 'string', 'max' => 255],
            [['anons_uz', 'anons_oz', 'anons_ru'], 'string', 'max' => 500],
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
            'name_oz' => 'Name Oz',
            'name_ru' => 'Name Ru',
            'anons_uz' => 'Anons Uz',
            'anons_oz' => 'Anons Oz',
            'anons_ru' => 'Anons Ru',
            'icon' => 'Icon',
            'sort_order' => 'Sort Order',
            'enabled' => 'Enabled',
        ];
    }
}
