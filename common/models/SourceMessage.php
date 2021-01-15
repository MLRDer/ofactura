<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "source_message".
 *
 * @property int $id
 * @property string $key_name
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $name_oz
 * @property int|null $enabled
 * @property int|null $type
 */
class SourceMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'source_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_name'], 'required'],
            [['enabled','type'], 'integer'],
            [['key_name', 'name_uz', 'name_ru', 'name_oz'], 'string', 'max' => 500],
            [['key_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_name' => 'Key Name',
            'name_uz' => 'Узб',
            'name_ru' => 'Рус',
            'name_oz' => 'Ozb',
            'enabled' => 'Enabled',
        ];
    }
}
