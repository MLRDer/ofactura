<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contract_parts".
 *
 * @property int $id
 * @property string $contract_id
 * @property int $OrdNo
 * @property string $Title
 * @property string $Body
 * @property int|null $enabled
 * @property int|null $template_id
 */
class ContractParts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract_parts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'Title', 'Body'], 'required'],
            [[ 'OrdNo', 'enabled', 'template_id'], 'integer'],
            [['Body'], 'string'],
            [['Title'], 'string', 'max' => 1000],
            [['contract_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_id' => 'Contract ID',
            'OrdNo' => 'Ord No',
            'Title' => 'Title',
            'Body' => 'Body',
            'enabled' => 'Enabled',
            'template_id' => 'Template ID',
        ];
    }
}
