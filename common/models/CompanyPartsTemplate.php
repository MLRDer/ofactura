<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_parts_template".
 *
 * @property int $id
 * @property string $tin
 * @property string $name
 * @property int|null $type
 * @property int|null $enabled
 */
class CompanyPartsTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_parts_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tin', 'name'], 'required'],
            [['type', 'enabled'], 'integer'],
            [['tin'], 'string', 'max' => 9],
            [['name'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'tin' => Yii::t('main', 'Tin'),
            'name' => Yii::t('main', 'Name'),
            'type' => Yii::t('main', 'Type'),
            'enabled' => Yii::t('main', 'Enabled'),
        ];
    }
}
