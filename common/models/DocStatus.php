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
//
    const NEW_DOC = 1;
    const PROVIDED = 2;
    const ACCEPTED = 3;
    const REJECTED = 4;
    const CANCELED = 6;

    const STATUS_NEW = 1;
    const STATUS_SEND = 2;
    const STATUS_ACCEPT = 3;
    const STATUS_REJECT = 4;
    const STATUS_WAIT_ACCEPT = 5;
    const STATUS_CANCELED = 6;
    const STATUS_WAIT_AGENT = 7;
    const STATUS_ACCEPT_AGENT = 8;
    const STATUS_REJECT_AGENT = 9;

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



    public static function getStatus($status){
        $data = [
            self::STATUS_NEW =>Yii::t('main','Новый'),
            self::STATUS_SEND =>Yii::t('main','Отправлено'),
            self::STATUS_ACCEPT =>Yii::t('main','Подтвержденный'),
            self::STATUS_REJECT =>Yii::t('main','Отказано'),
            self::STATUS_WAIT_ACCEPT =>Yii::t('main','Ожидается подпись'),
            self::STATUS_CANCELED =>Yii::t('main','Отменен'),
            self::STATUS_WAIT_AGENT =>Yii::t('main','Agentni kutyapti'),
            self::STATUS_ACCEPT_AGENT =>Yii::t('main','Agent tasdiqlagan'),
            self::STATUS_REJECT_AGENT =>Yii::t('main','Agent rad etgan'),
        ];
        $class = "";
        if($status==self::STATUS_NEW)
            $class = "text-info";
        if($status==self::STATUS_SEND || $status==self::STATUS_WAIT_ACCEPT)
            $class = "warning";
        if($status==self::STATUS_ACCEPT || $status==self::STATUS_ACCEPT_AGENT)
            $class = "success";
        if($status==self::STATUS_REJECT || $status==self::STATUS_CANCELED || $status==self::STATUS_REJECT_AGENT)
            $class = "danger";

        return   "<div class='{$class}'>". $data[$status]."</div>";
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
