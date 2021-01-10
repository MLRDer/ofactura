<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property string $tin
 * @property int $type
 * @property string $doc_id
 * @property string $title_uz
 * @property string $title_ru
 * @property string|null $anons_uz
 * @property string|null $anons_ru
 * @property string $path
 * @property int|null $is_view
 * @property string $created_date
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const TYPE_FACTURA = 10;
    const TYPE_FACTURA_ACCEPT = 20;
    const TYPE_FACTURA_REJECT = 30;
    const NOT_VIEW = 1;
    const VIEWED = 2;

    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tin', 'type', 'title_uz', 'title_ru', 'path'], 'required'],
            [['type', 'is_view'], 'integer'],
            [['created_date'], 'safe'],
            [['tin'], 'string', 'max' => 9],
            [['title_uz', 'title_ru', 'path'], 'string', 'max' => 255],
            [['anons_uz', 'anons_ru'], 'string', 'max' => 500],
            [[ 'doc_id'], 'string', 'max' => 50],
        ];
    }

//    public static function SetNotifiyIsCallback($title){
//
//    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'tin' => Yii::t('main', 'Tin'),
            'type' => Yii::t('main', 'Type'),
            'title_uz' => Yii::t('main', 'Title Uz'),
            'title_ru' => Yii::t('main', 'Title Ru'),
            'anons_uz' => Yii::t('main', 'Anons Uz'),
            'anons_ru' => Yii::t('main', 'Anons Ru'),
            'path' => Yii::t('main', 'Path'),
            'is_view' => Yii::t('main', 'Is View'),
            'created_date' => Yii::t('main', 'Created Date'),
        ];
    }
}
