<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aferta".
 *
 * @property int $id
 * @property string $title_uz
 * @property string|null $title_oz
 * @property string|null $title_ru
 * @property string $body_uz
 * @property string|null $body_oz
 * @property string|null $body_ru
 * @property int|null $enabled
 */
class Aferta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aferta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_uz', 'body_uz'], 'required'],
            [['body_uz', 'body_oz', 'body_ru'], 'string'],
            [['enabled'], 'integer'],
            [['title_uz', 'title_oz', 'title_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_uz' => 'Title Uz',
            'title_oz' => 'Title Oz',
            'title_ru' => 'Title Ru',
            'body_uz' => 'Body Uz',
            'body_oz' => 'Body Oz',
            'body_ru' => 'Body Ru',
            'enabled' => 'Enabled',
        ];
    }
}
