<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contract_clients".
 *
 * @property int $id
 * @property string $contract_id
 * @property string $Tin
 * @property string $Name
 * @property string $Address
 * @property string|null $WorkPhone
 * @property string|null $Mobile
 * @property string|null $Fax
 * @property string $Oked
 * @property string $Account
 * @property string $BankId
 * @property string $FizTin
 * @property string $Fio
 * @property string|null $BranchCode
 * @property string|null $BranchName
 * @property int|null $enabled
 */
class ContractClients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract_clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'Tin', 'Name', 'Address', 'FizTin', 'Fio'], 'required'],
            [['enabled'], 'integer'],
            [['contract_id', 'Oked'], 'string', 'max' => 50],
            [['Tin', 'FizTin'], 'string', 'max' => 9],
            [['Name', 'Address'], 'string', 'max' => 1000],
            [['WorkPhone', 'Mobile', 'Fax', 'Account', 'Fio', 'BranchCode', 'BranchName'], 'string', 'max' => 500],
            [['BankId'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'contract_id' => Yii::t('main', 'Contract ID'),
            'Tin' => Yii::t('main', 'Tin'),
            'Name' => Yii::t('main', 'Name'),
            'Address' => Yii::t('main', 'Address'),
            'WorkPhone' => Yii::t('main', 'Work Phone'),
            'Mobile' => Yii::t('main', 'Mobile'),
            'Fax' => Yii::t('main', 'Fax'),
            'Oked' => Yii::t('main', 'Oked'),
            'Account' => Yii::t('main', 'Account'),
            'BankId' => Yii::t('main', 'Bank ID'),
            'FizTin' => Yii::t('main', 'Fiz Tin'),
            'Fio' => Yii::t('main', 'Fio'),
            'BranchCode' => Yii::t('main', 'Branch Code'),
            'BranchName' => Yii::t('main', 'Branch Name'),
            'enabled' => Yii::t('main', 'Enabled'),
        ];
    }
}
