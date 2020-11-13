<?php

namespace common\models;

use common\components\ActiveRecordCustom;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "olympiad".
 *
 * @property int $id
 * @property int $olympiad_category_id
 * @property int $region_id
 * @property int $sub_region_id
 * @property string $name_uz
 * @property string $name_ru
 * @property string $name_en
 * @property string $description_uz
 * @property string $description_ru
 * @property string $description_en
 * @property int $price
 * @property int $logo_id
 * @property int $position
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 *
 * @property User $createdBy
 * @property User $updatedBy

 * @property string $logoUrl
 * @property int $priceSum
 */
class Olympiad extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $photo = "";

    public static function tableName()
    {
        return 'olympiad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['olympiad_category_id', 'region_id', 'sub_region_id', 'name_uz', 'name_ru', 'name_en', 'logo_id', 'created_by', 'updated_by', 'price'], 'required'],
            [['olympiad_category_id', 'region_id', 'sub_region_id', 'logo_id', 'position', 'created_by', 'updated_by', 'status'], 'integer'],
            [['description_uz', 'description_ru', 'description_en'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['price'], 'integer', 'min' => 1],
            [['name_uz', 'name_ru', 'name_en'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'olympiad_category_id' => Yii::t('main', 'Olympiad Category ID'),
            'region_id' => Yii::t('main', 'Region ID'),
            'sub_region_id' => Yii::t('main', 'Sub Region ID'),
            'name_uz' => Yii::t('main', 'Name Uz'),
            'name_ru' => Yii::t('main', 'Name Ru'),
            'name_en' => Yii::t('main', 'Name En'),
            'description_uz' => Yii::t('main', 'Description Uz'),
            'description_ru' => Yii::t('main', 'Description Ru'),
            'description_en' => Yii::t('main', 'Description En'),
            'price' => Yii::t('main', 'Price'),
            'logo_id' => Yii::t('main', 'Logo ID'),
            'position' => Yii::t('main', 'Position'),
            'created_at' => Yii::t('main', 'Created At'),
            'updated_at' => Yii::t('main', 'Updated At'),
            'created_by' => Yii::t('main', 'Created By'),
            'updated_by' => Yii::t('main', 'Updated By'),
            'status' => Yii::t('main', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

}
