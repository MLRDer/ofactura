<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asdasd".
 *
 * @property int $id
 * @property int $test_type
 */
class Asdasd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asdasd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_type'], 'required'],
            [['test_type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_type' => 'Test Type',
        ];
    }
}
