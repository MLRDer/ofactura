<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "web_menyu".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name_oz
 * @property string $name_ru
 * @property string $name_uz
 * @property string $icon
 * @property string $path
 * @property int $sort_order
 * @property int $enabled
 */
class WebMenyu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'web_menyu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort_order', 'enabled'], 'integer'],
            [['name_oz', 'name_ru', 'name_uz', 'path', 'sort_order', 'enabled'], 'required'],
            [['name_oz', 'path', 'name_ru', 'name_uz', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name_oz' => 'Name Oz',
            'name_ru' => 'Name Ru',
            'name_uz' => 'Name Uz',
            'icon' => 'Icon',
            'path' => 'Path',
            'sort_order' => 'Sort Order',
            'enabled' => 'Enabled',
        ];
    }
}
