<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $tin
 * @property int $ns10_code
 * @property int $ns11_code
 * @property string $district_id
 * @property int $oked
 * @property int $director_tin
 * @property string $director
 * @property string $accountant
 * @property string|null $reg_code
 * @property string|null $mfo
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property int|null $status
 * @property int|null $invoices_sum
 * @property int|null $tarif_id
 * @property int|null $type
 * @property int|null $enabled
 * @property int|null $is_aferta
 * @property int|null $count_login
 * @property int|null $is_online
 * @property string $aferta_text
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */


    public $company_name;
    public $reg_name;
    public $distric_name;

    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'tin', 'ns10_code', 'ns11_code', 'name'], 'required'],
            [['parent_id', 'tin', 'ns10_code', 'ns11_code', 'status', 'type', 'enabled','oked','director_tin','invoices_sum','tarif_id','is_aferta','is_online','count_login'], 'integer'],
            [['name', 'address', 'phone','director','accountant','district_id'], 'string', 'max' => 255],
            [['reg_code', 'mfo'], 'string', 'max' => 50],
            [['aferta_text'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' =>Yii::t('main','Parent ID'),
            'tin' =>Yii::t('main', 'STIR'),
            'ns10_code' => Yii::t('main','Viloyat'),
            'ns11_code' =>Yii::t('main', 'Tuman'),
            'name' =>Yii::t('main', 'Korxona nomi'),
            'address' =>Yii::t('main', 'Manzili'),
            'phone' =>Yii::t('main', 'Tel'),
            'invoices_sum' =>Yii::t('main', 'Xisob qoldig`i'),
            'status' =>Yii::t('main', 'Xolati'),
            'tarif_id' =>Yii::t('main', 'Tarifi'),
            'type' =>Yii::t('main', 'Tip'),
            'enabled' =>Yii::t('main', 'Faol'),
            'created_date'=>"Aferta sana"
        ];
    }
}
