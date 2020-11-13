<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "web_feed_back".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_oz
 * @property string|null $name_ru
 * @property string|null $body_uz
 * @property string|null $body_oz
 * @property string|null $body_ru
 * @property int|null $sort_order
 * @property int|null $enabled
 */
class WebFeedBack extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'web_feed_back';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body_uz', 'body_oz', 'body_ru'], 'string'],
            [['sort_order', 'enabled'], 'integer'],
            [['name_uz', 'name_oz', 'name_ru'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => 'Uzb',
            'name_oz' => 'Ozb',
            'name_ru' => 'Rus',
            'body_uz' => 'Uzb',
            'body_oz' => 'Ozb',
            'body_ru' => 'Rus',
            'sort_order' => 'Sort Order',
            'enabled' => 'Enabled',
        ];
    }
}
