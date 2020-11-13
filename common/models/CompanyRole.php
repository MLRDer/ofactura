<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_role".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 */
class CompanyRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }
}
