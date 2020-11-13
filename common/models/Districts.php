<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property int $id
 * @property int|null $region_id
 * @property int|null $parent_region_id
 * @property string $name_uz
 * @property int|null $district_id
 * @property int|null $ditrict_code
 * @property int $enabled
 * @property string|null $name_ru
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'parent_region_id', 'ditrict_code', 'enabled'], 'integer'],
            [['name_uz', 'enabled'], 'required'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [[ 'district_id',], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function getSubRegions() {
        return self::find()->filterWhere(['parent_region_id' => $this->region_id])->orderBy(['NAME_UZ' => SORT_ASC])->all();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region ID',
            'parent_region_id' => 'Parent Region ID',
            'name_uz' => 'Name Uz',
            'district_id' => 'District ID',
            'ditrict_code' => 'Ditrict Code',
            'enabled' => 'Enabled',
            'name_ru' => 'Name Ru',
        ];
    }
}
