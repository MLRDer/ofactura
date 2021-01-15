<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classifications".
 *
 * @property int $id
 * @property string $tin
 * @property string|null $groupCode
 * @property string $classCode
 * @property string $className
 * @property string|null $productCode
 * @property string|null $productName
 * @property int|null $enabled
 */
class Classifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tin', 'classCode', 'className'], 'required'],
            [['enabled'], 'integer'],
            [['tin'], 'string', 'max' => 9],
            [['groupCode', 'classCode', 'productCode'], 'string', 'max' => 50],
            [['className', 'productName'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tin' => 'Tin',
            'groupCode' => Yii::t('main', 'Group Code'),
            'classCode' => Yii::t('main', 'Class Code'),
            'className' => Yii::t('main', 'Class Name'),
            'productCode' => Yii::t('main', 'Product Code'),
            'productName' => Yii::t('main', 'Product Name'),
            'enabled' => 'Enabled',
        ];
    }
}
