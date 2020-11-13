<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_users".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $users_id
 * @property int|null $tin
 * @property string|null $role_id
 * @property int|null $enabled
 * @property int|null $status
 */
class CompanyUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $fio;
    public $role_items;
    public $name;
    public static function tableName()
    {
        return 'company_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tin', 'company_id','tin' ,'users_id', 'enabled', 'status','role_items'], 'integer'],
            [['role_id'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'users_id' => 'Users ID',
            'enabled' => 'Enabled',
            'status' => 'Status',
        ];
    }
}
