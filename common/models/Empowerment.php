<?php

namespace common\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "empowerment".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $EmpowermentId
 * @property string|null $EmpowermentProductId
 * @property string $EmpowermentNo
 * @property string $EmpowermentDateOfIssue
 * @property string $EmpowermentDateOfExpire
 * @property string $ContractNo
 * @property string $ContractDate
 * @property string $AgentEmpowermentId
 * @property int $AgentTin
 * @property string $AgentJobTitle
 * @property string $AgentPassportNumber
 * @property string $AgentFio
 * @property string $AgentPassportDateOfIssue
 * @property string $AgentPassportIssuedBy
 * @property string $SellerTin
 * @property string $SellerName
 * @property string|null $SellerAccount
 * @property int|null $SellerBankId
 * @property string|null $SellerAddress
 * @property string|null $SellerMobile
 * @property string|null $SellerWorkPhone
 * @property int|null $SellerOked
 * @property string|null $SellerDistrictId
 * @property string|null $SellerDirector
 * @property string|null $SellerAccountant
 * @property string $BuyerTin
 * @property string $BuyerName
 * @property string|null $BuyerAccount
 * @property string|null $BuyerBankId
 * @property string|null $BuyerAddress
 * @property string|null $BuyerMobile
 * @property string|null $BuyerWorkPhone
 * @property int|null $BuyerOked
 * @property string|null $BuyerDistrictId
 * @property string|null $BuyerDirector
 * @property string|null $BuyerAccountant
 * @property string|null $items_json
 * @property string|null $docs_pks7
 * @property int|null $status
 * @property int|null $type
 * @property int $enabled
 * @property string $created_date
 */
class Empowerment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empowerment';
    }

    const TYPE_IN = 1;
    const TYPE_OUT = 2;

    const NEW_DATA = 1;
    const SEND = 2;
    const ACCEPTED = 3;
    const REJECTED = 4;
    const NO_ACCEPTED= 5;
    const ERROR_DATA = 7;
    const CANCELED = 6;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'AgentTin',   'SellerOked',  'BuyerTin',  'BuyerOked',  'status', 'type', 'enabled'], 'integer'],
            [['EmpowermentNo', 'EmpowermentDateOfIssue', 'EmpowermentDateOfExpire', 'ContractNo', 'ContractDate', 'AgentTin', 'AgentJobTitle', 'AgentPassportNumber', 'AgentFio', 'AgentPassportDateOfIssue', 'AgentPassportIssuedBy', 'SellerTin', 'SellerName',  'BuyerName', 'enabled'], 'required'],
            [['EmpowermentDateOfIssue', 'EmpowermentDateOfExpire', 'ContractDate', 'AgentPassportDateOfIssue','items_json','created_date'], 'safe'],
            [['EmpowermentNo', 'ContractNo', 'AgentPassportNumber','SellerBankId', 'SellerMobile','SellerDistrictId','BuyerBankId', 'BuyerDistrictId','SellerWorkPhone', 'BuyerMobile', 'BuyerWorkPhone','AgentEmpowermentId'], 'string', 'max' => 50],
            [['AgentJobTitle', 'AgentFio', 'AgentPassportIssuedBy', 'SellerName', 'SellerAccount', 'SellerAddress', 'SellerDirector', 'SellerAccountant', 'BuyerName', 'BuyerAccount', 'BuyerAddress', 'BuyerDirector', 'BuyerAccountant'], 'string', 'max' => 255],
            [['docs_pks7'],'string'],
            [['SellerTin','BuyerTin'],'string','max'=>9]

        ];
    }

    /**
     * {@inheritdoc}
     */

    public static function SetData($data,$tin,$type_in){
        $reason="";
//        var_dump($data);die;
        $company = Company::findOne(['tin'=>$tin]);
        if(empty($company))
            $reason = "Kiruvchi xujjat bizga tegishli emas";
        if($reason=="") {
            $model = new Empowerment();
            $model->EmpowermentId = $data['EmpowermentId'];
            $model->SellerTin = $data['SellerTin'];
            $model->BuyerTin = $data['BuyerTin'];
            $model->SellerTin = $data['SellerTin'];

            $model->ContractNo = $data['ContractDoc']['ContractNo'];
            $model->ContractDate = $data['ContractDoc']['ContractDate'];

            $model->EmpowermentNo = $data['EmpowermentDoc']['EmpowermentNo'];
            $model->EmpowermentProductId =$data['ProductList']['EmpowermentProductId'];
            $model->EmpowermentDateOfIssue = $data['EmpowermentDoc']['EmpowermentDateOfIssue'];
            $model->EmpowermentDateOfExpire = $data['EmpowermentDoc']['EmpowermentDateOfExpire'];

            $model->AgentFio = $data['Agent']['Fio'];
            $model->AgentJobTitle = $data['Agent']['JobTitle'];
            $model->AgentPassportNumber = $data['Agent']['Passport']['Number'];
            $model->AgentPassportIssuedBy = $data['Agent']['Passport']['IssuedBy'];
            $model->AgentPassportDateOfIssue = $data['Agent']['Passport']['DateOfIssue'];
            $model->AgentTin = $data['Agent']['AgentTin'];
            $model->AgentEmpowermentId = $data['Agent']['AgentEmpowermentId'];

            $model->SellerName = $data['Seller']['Name'];
            $model->SellerAccount = $data['Seller']['Account'];
            $model->SellerBankId = $data['Seller']['BankId'];
            $model->SellerAddress = $data['Seller']['Address'];
            $model->SellerMobile = $data['Seller']['Mobile'];
            $model->SellerWorkPhone = $data['Seller']['WorkPhone'];
            $model->SellerOked = $data['Seller']['Oked'];
            $model->SellerDistrictId = (isset($data['Seller']['DistrictId'])) ?$data['Seller']['DistrictId']:"";
            $model->SellerDirector = $data['Seller']['Director'];
            $model->SellerAccountant = $data['Seller']['Accountant'];
//        $model->VatRegCode = $data['Seller']['VatRegCode'];

            $model->BuyerName = $data['Buyer']['Name'];
            $model->BuyerAccount = $data['Buyer']['Account'];
            $model->BuyerBankId = $data['Buyer']['BankId'];
            $model->BuyerAddress = $data['Buyer']['Address'];
            $model->BuyerMobile = $data['Buyer']['Mobile'];
            $model->BuyerWorkPhone = $data['Buyer']['WorkPhone'];
            $model->BuyerOked = $data['Buyer']['Oked'];
//            $model->BuyerDistrictId = $data['Buyer']['DistrictId'];
            $model->BuyerDistrictId = (isset($data['Buyer']['DistrictId'])) ?$data['Buyer']['DistrictId']:"";
            $model->BuyerDirector = $data['Buyer']['Director'];
            $model->BuyerAccountant = $data['Buyer']['Accountant'];

            $model->type = $type_in;
            $model->status = Docs::NO_ACCEPTED;
            $model->enabled = 1;
            $model->company_id = $company->id;
            $model->created_date = date('Y-m-d H:i:s');
            if(!$model->save()){
                $reason = Json::encode($model->getErrors());
            }
        }

        if($reason==""){
            foreach ($data['ProductList']['Products'] as $items){
                $products = new EmpowermentProduct();
                $products->company_id = $model->company_id;
                $products->empowerment_id = $model->id;
                $products->Name = $items['Name'];
                $products->MeasureId = $items['MeasureId'];
                $products->Count = $items['Count'];
                if(!$products->save()){
                    $reason .= Json::encode($products->getErrors());
                }

            }
        }

        if($reason==""){
            $result = [
              'success'=>true,
              'reason'=>""
            ];
        } else {
            $result = [
                'success'=>false,
                'reason'=>$reason
            ];
        }
        return $result;
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'EmpowermentNo' => Yii::t('main', 'Empowerment No'),
            'EmpowermentDateOfIssue' => Yii::t('main','Empowerment Date Of Issue'),
            'EmpowermentDateOfExpire' =>Yii::t('main', 'Empowerment Date Of Expire'),
            'ContractNo' => Yii::t('main','Contract No'),
            'ContractDate' => Yii::t('main','Contract Date'),
            'AgentTin' => Yii::t('main','Agent Tin'),
            'AgentJobTitle' =>Yii::t('main', 'Agent Job Title'),
            'AgentPassportNumber' =>Yii::t('main', 'Agent Passport Number'),
            'AgentFio' => Yii::t('main','Agent Fio'),
            'AgentPassportDateOfIssue' =>Yii::t('main', 'Agent Passport Date Of Issue'),
            'AgentPassportIssuedBy' =>Yii::t('main', 'Agent Passport Issued By'),
            'SellerTin' =>Yii::t('main', 'Seller Tin'),
            'SellerName' => Yii::t('main','Seller Name'),
            'SellerAccount' =>Yii::t('main', 'Seller Account'),
            'SellerBankId' =>Yii::t('main', 'Seller Bank ID'),
            'SellerAddress' =>Yii::t('main', 'Seller Address'),
            'SellerMobile' =>Yii::t('main', 'Seller Mobile'),
            'SellerWorkPhone' =>Yii::t('main', 'Seller Work Phone'),
            'SellerOked' =>Yii::t('main', 'Seller Oked'),
            'SellerDistrictId' =>Yii::t('main', 'Seller District ID'),
            'SellerDirector' =>Yii::t('main', 'Seller Director'),
            'SellerAccountant' =>Yii::t('main', 'Seller Accountant'),
            'BuyerTin' => Yii::t('main','Buyer Tin'),
            'BuyerName' => Yii::t('main','Buyer Name'),
            'BuyerAccount' =>Yii::t('main', 'Buyer Account'),
            'BuyerBankId' => Yii::t('main','Buyer Bank ID'),
            'BuyerAddress' => Yii::t('main','Buyer Address'),
            'BuyerMobile' => Yii::t('main','Buyer Mobile'),
            'BuyerWorkPhone' =>Yii::t('main', 'Buyer Work Phone'),
            'BuyerOked' => Yii::t('main','Buyer Oked'),
            'BuyerDistrictId' =>Yii::t('main', 'Buyer District ID'),
            'BuyerDirector' =>Yii::t('main', 'Buyer Director'),
            'BuyerAccountant' =>Yii::t('main', 'Buyer Accountant'),
            'status' => Yii::t('main','Status'),
            'type' => 'Type',
            'enabled' => 'Enabled',
        ];
    }
}
