<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use cabinet\classes\consts\ExcelConst as Consts;
use yii\web\UploadedFile;

/**
 * This is the model class for table "docs".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $FacturaNo
 * @property string|null $FacturaId
 * @property string|null $FacturaDate
 * @property string|null $ContractNo
 * @property string|null $ContractDate
 * @property string|null $EmpowermentNo
 * @property string|null $EmpowermentDateOfIssue
 * @property string|null $AgentFio
 * @property string|null $AgentFacturaId
 * @property string|null $AgentTin
 * @property string|null $ItemReleasedFio
 * @property int|null $SellerTin
 * @property string|null $SellerName
 * @property string|null $SellerAccount
 * @property string|null $SellerBankId
 * @property string|null $SellerAddress
 * @property string|null $SellerMobile
 * @property string|null $SellerWorkPhone
 * @property int|null $SellerOked
 * @property string|null $SellerDistrictId
 * @property string|null $SellerDirector
 * @property string|null $SellerAccountant
 * @property string|null $SellerVatRegCode
 * @property int|null $BuyerTin
 * @property string|null $BuyerName
 * @property string|null $BuyerAccount
 * @property string|null $BuyerBankId
 * @property string|null $BuyerAddress
 * @property string|null $BuyerMobile
 * @property string|null $BuyerWorkPhone
 * @property string|null $BuyerOked
 * @property string|null $BuyerDistrictId
 * @property string|null $BuyerDirector
 * @property string|null $BuyerAccountant
 * @property string|null $BuyerVatRegCode
 * @property string|null $docs_pks7
 * @property string|null $json_data
 * @property string|null $json_items
 * @property string|null $created_date
 * @property string|null $send_date
 * @property string|null $accepted_date
 * @property string|null $notes
 * @property int|null $status
 * @property int|null $type_doc
 * @property int|null $enabled
 * @property int|null $user_id
 * @property int|null $HasFuel
 * @property int|null $HasVat
 * @property string|null $FacturaProductId
 * @property int|null $reestr_id
 */
class Docs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;
    public $name;

    public $countDoc;

    const TYPE_IN = 1;
    const TYPE_OUT = 2;
    const TYPE_IN_AGENT = 3;

    const NEW_DATA = 1;
    const SEND = 2;
    const ACCEPTED = 3;
    const REJECTED = 4;
    const NO_ACCEPTED= 5;

    const CANCELED = 6;
    const AGENT_Wait = 7;
    const AGENT_ACCEPTED = 8;
    const AGENT_REJECTED = 9;

    public static function tableName()
    {
        return 'docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FacturaNo', 'FacturaDate', 'ContractNo', 'ContractDate', 'SellerTin', 'SellerName'], 'required'],
            [['company_id', 'SellerTin', 'SellerOked', 'BuyerTin',   'status', 'enabled', 'user_id','type_doc','HasFuel','HasVat','reestr_id'], 'integer'],
            [['FacturaDate', 'ContractDate', 'EmpowermentDateOfIssue', 'created_date', 'send_date', 'accepted_date'], 'safe'],
            [['docs_pks7', 'json_data', 'json_items','BuyerOked'], 'string'],
            ['file', 'file', 'extensions' => 'xlsx'],
            [['FacturaNo', 'ContractNo', 'AgentFio', 'ItemReleasedFio', 'SellerName', 'SellerAccount', 'SellerBankId', 'SellerAddress', 'SellerDirector', 'SellerAccountant', 'SellerVatRegCode', 'BuyerName', 'BuyerAccount', 'BuyerBankId', 'BuyerAddress', 'BuyerDirector', 'BuyerAccountant', 'BuyerVatRegCode','SellerMobile', 'SellerWorkPhone', 'BuyerMobile', 'BuyerWorkPhone','FacturaId'], 'string', 'max' => 255],
            [['notes'],'string'],
            [['EmpowermentNo','AgentFacturaId', 'FacturaProductId'], 'string', 'max' => 50],
            [['AgentTin'], 'string', 'max' => 50],
            [['SellerDistrictId', 'BuyerDistrictId',], 'safe'],


        ];
    }

    /**
     * {@inheritdoc}
     */


    public function upload()
    {
//        if (!$this->validate())
//            return $this->errors;

        if(!is_dir(Yii::getAlias(Consts::FILE_PATH)))
            FileHelper::createDirectory(Yii::getAlias(Consts::FILE_PATH));

        if(is_file(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME)))
            unlink(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME));

        $file = UploadedFile::getInstance($this, 'file');
        $file->saveAs(Yii::getAlias(Consts::FILE_PATH . Consts::FILE_NAME));

        return true;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Korxona ID',
            'FacturaNo' => Yii::t('main', 'Factura №'),
            'FacturaDate' => Yii::t('main','Factura sanasi'),
            'ContractNo' => Yii::t('main','Shartnom №'),
            'ContractDate' => Yii::t('main','Shartnoma sanasi'),
            'EmpowermentNo' =>Yii::t('main', 'Ishonchnoma №'),
            'EmpowermentDateOfIssue' =>Yii::t('main', 'Berilgan sanasi'),
            'AgentFio' => Yii::t('main','AgentFio'),
            'AgentTin' =>Yii::t('main', 'AgentTin'),
            'ItemReleasedFio' => Yii::t('main','Item Released Fio'),
            'SellerTin' =>Yii::t('main', 'SellerTin'),
            'SellerName' => Yii::t('main','SellerName'),
            'SellerAccount' =>Yii::t('main', 'SellerAccount'),
            'SellerBankId' => Yii::t('main','SellerBankId'),
            'SellerAddress' =>Yii::t('main', 'SellerAddress'),
            'SellerMobile' =>Yii::t('main', 'SellerMobile'),
            'SellerWorkPhone' =>Yii::t('main', 'SellerWorkPhone'),
            'SellerOked' =>Yii::t('main', 'SellerOked'),
            'SellerDistrictId' =>Yii::t('main', 'SellerDistrictId'),
            'SellerDirector' =>Yii::t('main', 'SellerDirector'),
            'SellerAccountant' =>Yii::t('main', 'SellerAccountant'),
            'SellerVatRegCode' =>Yii::t('main', 'SellerVatRegCode'),
            'BuyerTin' => Yii::t('main','BuyerTin'),
            'BuyerName' => Yii::t('main','BuyerName'),
            'BuyerAccount' => Yii::t('main','BuyerAccount'),
            'BuyerBankId' => Yii::t('main','BuyerBankId'),
            'BuyerAddress' => Yii::t('main','BuyerAddress'),
            'BuyerMobile' =>Yii::t('main', 'BuyerMobile'),
            'BuyerWorkPhone' =>Yii::t('main', 'BuyerWorkPhone'),
            'BuyerOked' =>Yii::t('main', 'BuyerOked'),
            'BuyerDistrictId' => Yii::t('main','BuyerDistrictId'),
            'BuyerDirector' => Yii::t('main','BuyerDirector'),
            'BuyerAccountant' =>Yii::t('main', 'BuyerAccountant'),
            'BuyerVatRegCode' =>Yii::t('main', 'BuyerVatRegCode'),
            'docs_pks7' => Yii::t('main','Docs Pks7'),
            'json_data' => Yii::t('main','Json Data'),
            'json_items' => Yii::t('main','Json Items'),
            'created_date' =>Yii::t('main', 'Created Date'),
            'send_date' =>Yii::t('main', 'Send Date'),
            'accepted_date' =>Yii::t('main', 'Accepted Date'),
            'status' => Yii::t('main','Status'),
            'enabled' =>Yii::t('main', 'Enabled'),
            'user_id' => Yii::t('main','User ID'),
            'HasFuel' => Yii::t('main','акцизного налога'),
        ];
    }
}
