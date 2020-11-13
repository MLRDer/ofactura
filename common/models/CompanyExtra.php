<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_extra".
 *
 * @property int $id
 * @property int $company_id
 * @property int $extra_id
 * @property int $enabled
 */
class CompanyExtra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_extra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'extra_id', 'enabled'], 'required'],
            [['company_id', 'extra_id', 'enabled'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'extra_id' => 'Extra ID',
            'enabled' => 'Enabled',
        ];
    }
}
