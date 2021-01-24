<?php

namespace common\models;

use cabinet\models\Components;
use Yii;

/**
 * This is the model class for table "format_no".
 *
 * @property int $id
 * @property string $tin
 * @property int $type_doc
 * @property string|null $after_number
 * @property int $number
 * @property string|null $before_number
 * @property string|null $update_date
 * @property int|null $enabled
 */
class FormatNo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const TYPE_CONTRACT = 10;
    const TYPE_FACTURAS = 20;
    const TYPE_ACT = 30;
    const TYPE_EMP = 40;

    public static function tableName()
    {
        return 'format_no';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tin', 'type_doc', 'number'], 'required'],
            [['type_doc', 'number', 'enabled'], 'integer'],
            [['update_date'], 'safe'],
            [['tin'], 'string', 'max' => 9],
            [['after_number', 'before_number'], 'string', 'max' => 10],
        ];
    }

    public static function SetDefaultData($type){

            $model_contract = new FormatNo();
            $model_contract->tin = (string)Components::CompanyData('tin');
            $model_contract->type_doc = $type;
            $model_contract->number = 1;
            $model_contract->enabled = 1;
            if(!$model_contract->save()){
                var_dump($model_contract->getErrors());
            }
            return $model_contract;
    }


    public static function GetNextNumeric($type){
        $tin =Components::CompanyData('tin');
        $modelNumeric = FormatNo::find()->andWhere(['tin'=>$tin,'type_doc'=>$type])->one();
        $numeric ="";
        if(empty($modelNumeric)){
            $modelNumeric = new FormatNo();
            $modelNumeric->tin = $tin;
            $modelNumeric->number = 1;
            $modelNumeric->type_doc = $type;
            $modelNumeric->enabled = 1;
            $modelNumeric->save();
        }
        if($modelNumeric->enabled==1){
            $numeric = $modelNumeric->after_number.$modelNumeric->number.$modelNumeric->before_number;
        }
        return $numeric;
    }

    public static function SetNextNumeric($type){
        $modelNumeric = FormatNo::find()->andWhere(['tin'=>Components::CompanyData('tin'),'type_doc'=>$type])->one();
        $numeric ="";
        if(!empty($modelNumeric) && $modelNumeric->enabled==1){
            $modelNumeric->number ++;
            $modelNumeric->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'tin' => Yii::t('main', 'Tin'),
            'type_doc' => Yii::t('main', 'Type Doc'),
            'after_number' => Yii::t('main', 'After Number'),
            'number' => Yii::t('main', 'Number'),
            'before_number' => Yii::t('main', 'Before Number'),
            'update_date' => Yii::t('main', 'Update Date'),
            'enabled' => Yii::t('main', 'Enabled'),
        ];
    }
}
