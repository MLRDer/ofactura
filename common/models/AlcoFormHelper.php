<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alco_form_helper".
 *
 * @property int $id
 * @property int $form_items_id
 * @property string $name_uz
 * @property string|null $name_ru
 * @property int|null $form_id
 */
class AlcoFormHelper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alco_form_helper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_items_id', 'name_uz'], 'required'],
            [['form_items_id', 'form_id'], 'integer'],
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
            'form_items_id' => 'Form Items ID',
            'name_uz' => 'Name Uz',
            'name_ru' => 'Name Ru',
            'form_id' => 'Form ID',
        ];
    }
}
