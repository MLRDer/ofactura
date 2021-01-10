<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alco_form".
 *
 * @property int $id
 * @property string|null $name
 * @property int $category_id
 */
class AlcoForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alco_form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
        ];
    }
}
