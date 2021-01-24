<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_parts_template_items".
 *
 * @property int $id
 * @property int $template_id
 * @property int $OrdNo
 * @property string $Title
 * @property string $Body
 */
class CompanyPartsTemplateItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_parts_template_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['template_id', 'OrdNo', 'Title', 'Body'], 'required'],
            [['template_id', 'OrdNo'], 'integer'],
            [['Body'], 'string'],
            [['Title'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'template_id' => Yii::t('main', 'Template ID'),
            'OrdNo' => Yii::t('main', 'Ord No'),
            'Title' => Yii::t('main', 'Title'),
            'Body' => Yii::t('main', 'Body'),
        ];
    }
}
