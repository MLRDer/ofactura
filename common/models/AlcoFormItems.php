<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alco_form_items".
 *
 * @property int $id
 * @property int $form_id
 * @property int $category_id
 * @property string $label_uz
 * @property string|null $label_ru
 * @property int|null $input_type 1 - text, 2 - select, 3 - number
 * @property int|null $is_recured
 * @property string|null $placeholder_uz
 * @property string|null $placeholder_ru
 * @property int|null $sort_order
 * @property string|null $col_size_class
 */
class AlcoFormItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alco_form_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_id', 'category_id', 'label_uz'], 'required'],
            [['form_id', 'category_id', 'input_type', 'is_recured', 'sort_order'], 'integer'],
            [['label_uz', 'label_ru', 'placeholder_uz', 'placeholder_ru', 'col_size_class'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'form_id' => 'Form ID',
            'category_id' => 'Category ID',
            'label_uz' => 'Label Uz',
            'label_ru' => 'Label Ru',
            'input_type' => 'Input Type',
            'is_recured' => 'Is Recured',
            'placeholder_uz' => 'Placeholder Uz',
            'placeholder_ru' => 'Placeholder Ru',
            'sort_order' => 'Sort Order',
            'col_size_class' => 'Col Size Class',
        ];
    }
}
