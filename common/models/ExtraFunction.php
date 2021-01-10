<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "extra_function".
 *
 * @property int $id
 * @property string $name_uz
 * @property string|null $name_ru
 * @property string|null $path
 * @property string|null $icon_data
 * @property int|null $enabled
 */
class ExtraFunction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_function';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz'], 'required'],
            [['enabled'], 'integer'],
            [['name_uz', 'name_ru', 'path'], 'string', 'max' => 255],
            [['icon_data'], 'string', 'max' => 500],
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
            'path' => 'Path',
            'icon_data' => 'Icon Data',
            'enabled' => 'Enabled',
        ];
    }
}
