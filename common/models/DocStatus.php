<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc_status".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_oz
 * @property string|null $name_ru
 * @property string|null $class_name
 * @property int|null $type
 */
class DocStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const NEW_DOC = 1;
    const PROVIDED = 2;
    const ACCEPTED = 3;
    const REJECTED = 4;
    const CANCELED = 6;

    public static function tableName()
    {
        return 'doc_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz'], 'required'],
            [['type'], 'integer'],
            [['name_uz', 'name_ru','name_oz','class_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function getStatusName($id){
        $model = DocStatus::findOne(['id'=>$id]);
        return $model['name_'.Yii::$app->language];
    }

    public function getStatusClass($id){
        $model = DocStatus::findOne(['id'=>$id]);
        return $model['class_name'];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uz' => 'Name Uz',
            'name_oz' => 'Name Oz',
            'name_ru' => 'Name Ru',
            'type' => 'Type',
        ];
    }
}
