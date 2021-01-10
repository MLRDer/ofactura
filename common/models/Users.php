<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $fio
 * @property string|null $date_birth
 * @property int|null $sex
 * @property int|null $tin
 * @property int|null $phone
 * @property int|null $role_id
 * @property string $lang
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */


    public $password;

    public $first_name;
    public $second_name;
    public $last_name;


    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['tin', 'role_id', 'status', 'created_at', 'updated_at','sex','phone'], 'integer'],
            [['username','first_name','second_name','last_name', 'fio', 'password_hash', 'password_reset_token', 'email', 'verification_token','date_birth','lang','password'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->password_hash =  Yii::$app->security->generatePasswordHash($this->password);
            return true;
        } else {
            return false;
        }
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('main','Username'),
                'fio' => Yii::t('main','Fio'),


            'tin' => Yii::t('main','Tin'),
            'role_id' => Yii::t('main','Role ID'),
            'auth_key' => Yii::t('main','Auth Key'),
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => Yii::t('main','Email'),
            'status' => Yii::t('main','Status'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => Yii::t('main','Verification Token'),
        ];
    }
}
