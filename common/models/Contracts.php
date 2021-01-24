<?php

namespace common\models;

use cabinet\models\Components;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "contracts".
 *
 * @property string $Id
 * @property int|null $HasVat
 * @property string $ContractName
 * @property string $ContractNo
 * @property string $ContractDate
 * @property string $ContractExpireDate
 * @property string $ContractPlace
 * @property string $Tin
 * @property string $Name
 * @property string|null $Address
 * @property string|null $WorkPhone
 * @property string|null $Mobile
 * @property string|null $Fax
 * @property string|null $Oked
 * @property string|null $Account
 * @property string|null $BankId
 * @property string $FizTin
 * @property string|null $Fio
 * @property string|null $BranchCode
 * @property string|null $BranchName
 * @property string|null $json_items
 * @property string|null $clients
 * @property string|null $parts
 * @property int|null $status
 * @property int|null $type
 * @property int|null $created_date
 */
class Contracts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const STATUS_REESTR=-2;
    const STATUS_DUBL=-1;
    const STATUS_NEW=0;
    const STATUS_WAIT=10;
    const STATUS_SEND=15;
    const STATUS_CANCELLED=17;
    const STATUS_REJECTED=20;
    const STATUS_ACCEPTED=30;
    const STATUS_SEND_ACCEPTED =40;

    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";

    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'ContractName', 'ContractNo', 'ContractDate', 'ContractExpireDate', 'ContractPlace', 'Tin', 'Name', 'FizTin'], 'required'],
            [['HasVat', 'status', 'type', 'created_date'], 'integer'],
            [['ContractDate', 'ContractExpireDate'], 'safe'],
            [['json_items', 'clients', 'parts'], 'string'],
            [['Id', 'BankId', 'BranchCode'], 'string', 'max' => 50],
            [['ContractName', 'Name', 'Address', 'WorkPhone', 'Mobile', 'Fax', 'BranchName'], 'string', 'max' => 1000],
            [['ContractNo', 'ContractPlace', 'Account', 'Fio'], 'string', 'max' => 500],
            [['Tin', 'FizTin'], 'string', 'max' => 9],
            [['Oked'], 'string', 'max' => 100],
            [['Id'], 'unique'],
        ];
    }


    public function SetOwner(){
        $model = Company::findOne(['id'=>Components::GetId()]);
        $acountant = CompanyInvoicesHelpers::findOne(['company_id'=>Components::GetId()]);
        $accountant_num = "";
        $mfo = "";
        if(!empty($acountant)){
            $accountant_num = $acountant->invoices_number;
            $mfo =$acountant->mfo;
        }
        $this->Id = Components::getFacturaID();
        $this->status = self::STATUS_NEW;
        $this->Tin = $model->tin;
        $this->Name = $model->name;
        $this->Address = $model->address;
        $this->WorkPhone = $model->phone;
        $this->Mobile = $model->phone;
        $this->Fax = $model->phone;
        $this->Oked = $model->oked;
        $this->BankId = $mfo;
        $this->Account = $accountant_num;
        $this->Fio = $model->director;
        $this->FizTin = $model->director_tin;

    }


    public  function GetJsonData(){
        $model = $this;
        $act_id = $this->Id;
        $data = [
            "ContractId"=>$act_id,
            "HasVat"=>false,
            "ContractDoc"=>[
                "ContractName"=>$model->ContractName,
                "ContractNo"=>$model->ContractNo,
                "ContractDate"=>$model->ContractDate,
                "ContractExpireDate"=>$model->ContractExpireDate,
                "ContractPlace"=>$model->ContractPlace
            ],
            "Owner"=>[
                "Tin"=>$model->Tin,
                "Name"=>$model->Name,
                "Address"=>$model->Address,
                "Mobile"=>$model->Mobile,
                "Fax"=>$model->Fax,
                "Oked"=>$model->Oked,
                "Account"=>$model->Account,
                "BankId"=>$model->BankId,
                "FizTin"=>$model->FizTin,
                "Fio"=>$model->Fio,
                "BranchCode"=>$model->BranchCode,
                "BranchName"=>$model->BranchName,
            ],
            "Clients"=>self::GetClinetsJson($model->Id),
            "Products"=>self::GetProducts($model->Id),
            "Parts"=>self::GetParts($model->Id),
        ];
        return $data;
    }

    public function GetProducts($contract_id){
        $model = ContractProducts::find()->andWhere(['contract_id'=>$contract_id])->orderBy("OrdNo ASC")->all();
        $data = [];
        foreach ($model as $items){
            $data[]=[
                "OrdNo"=>$items->OrdNo,
                "BarCode"=>$items->BarCode,
                "CatalogCode"=>$items->CatalogCode,
                "CatalogName"=>$items->CatalogName,
                "Name"=>$items->Name,
                "MeasureId"=>$items->MeasureId,
                "Summa"=>$items->Summa,
                "Count"=>$items->Count,
                "DeliverySum"=>$items->DeliverySum,
                "VatRate"=>$items->VatRate,
                "VatSum"=>$items->VatSum,
                "DeliverySumWithVat"=>$items->DeliverySumWithVat,
                "WithoutVat"=>$items->WithoutVat,
            ];
        }
        return $data;
    }

    public function GetParts($contract_id){
        $model = ContractParts::find()->andWhere(['contract_id'=>$contract_id])->orderBy("OrdNo ASC")->all();
        $data = [];
        foreach ($model as $items){
            $data[]=[
                "OrdNo"=>$items->OrdNo,
                "Title"=>$items->Title,
                "Body"=>$items->Body,
            ];
        }
        return $data;
    }

    public static function GetClinetsJson($contract_id){
        $model = ContractClients::findAll(['contract_id'=>$contract_id]);
        $clients=[];
        foreach ($model as $items){
            $clients[]=[
                "Tin"=>$items->Tin,
                "Name"=>$items->Name,
                "Address"=>$items->Address,
                "Mobile"=>$items->Mobile,
                "Fax"=>$items->Fax,
                "Oked"=>$items->Oked,
                "Account"=>$items->Account,
                "BankId"=>$items->BankId,
                "FizTin"=>$items->FizTin,
                "Fio"=>$items->Fio,
                "BranchCode"=>$items->BranchCode,
                "BranchName"=>$items->BranchName,
            ];
        }
        return $clients;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('main', 'ID'),
            'HasVat' => Yii::t('main', 'Has Vat'),
            'ContractName' => Yii::t('main', 'Contract Name'),
            'ContractNo' => Yii::t('main', 'Contract No'),
            'ContractDate' => Yii::t('main', 'Contract Date'),
            'ContractExpireDate' => Yii::t('main', 'Contract Expire Date'),
            'ContractPlace' => Yii::t('main', 'Contract Place'),
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
            'json_items' => Yii::t('main', 'Json Items'),
            'clients' => Yii::t('main', 'Clients'),
            'parts' => Yii::t('main', 'Parts'),
            'status' => Yii::t('main', 'Status'),
            'type' => Yii::t('main', 'Type'),
            'created_date' => Yii::t('main', 'Created Date'),
        ];
    }

    public static function getStatus($status,$type=1){
        $data = [
            self::STATUS_NEW =>Yii::t('main','Сақланган'),
            self::STATUS_WAIT =>Yii::t('main','Imzo kutilmoqda'),
            self::STATUS_SEND =>Yii::t('main','Imzo kutilmoqda'),
            self::STATUS_CANCELLED =>Yii::t('main','Bekor qilindi'),
            self::STATUS_REJECTED =>Yii::t('main','Rad etildi'),
            self::STATUS_ACCEPTED =>Yii::t('main','Tasdqilandi'),
            self::STATUS_SEND_ACCEPTED =>Yii::t('main','Jo`natildi'),
        ];
        if($type==2){
            $data = [
                self::STATUS_NEW =>'<div class="text-info">'.Yii::t('main','Saved').'</div>',
                self::STATUS_WAIT=>'<span class="text-warning">'.Yii::t('main','Imzo kutilmoqda').'</span>',
                self::STATUS_SEND =>'<span class="text-warning">'.Yii::t('main','Imzo kutilmoqda').'</span>',
                self::STATUS_CANCELLED =>'<span class="secondary">'.Yii::t('main','Bekor qilindi').'</span>',
                self::STATUS_REJECTED =>'<span class="danger">'.Yii::t('main','Rad etildi').'</span>',
                self::STATUS_ACCEPTED =>'<span class="success">'.Yii::t('main','Tasdqilandi').'</span>',
                self::STATUS_SEND_ACCEPTED =>'<span class="success">'.Yii::t('main','Jo`natildi').'</span>',
            ];
        }
        return $data[$status];
    }

    public function beforeSave($insert)
    {
        if (!$this->isNewRecord && $this->status == self::STATUS_DUBL) {
            $this->status = self::STATUS_NEW;
        }
        // If new record qila olmaymiz sababi update bo`lgandaxam o`zgartrishimiz kerak. shuning uchun statusni tekshirayapmiz
        if ($this->status == self::STATUS_NEW) {
            $model = Json::decode($this->json_items);
            ContractProducts::deleteAll(['contract_id' => $this->Id]);
//            var_dump($model);die;

            $k = 0;
            $all_sum = 0;
            $all_sum_vat = 0;
            $missing_class_codes = [];
            foreach ($model as $items) {

                if (isset($items['ProductName']) &&
                    isset($items['ProductSumma']) &&
                    isset($items['ProductMeasureId']) &&
                    isset($items['ProductCount']) &&
                    isset($items['ProductDeliverySum']) &&
                    (array_key_exists('ProductCatalogName', $items))

                ) {

                    $tin = Components::CompanyData('tin');
//                    var_dump($items);
//                    die();
                    $k++;
                    $data = new ContractProducts();
                    $data->contract_id = $this->Id;
                    $data->OrdNo = (string)$k;
                    $data->Name = $items['ProductName'];
                    $data->MeasureId = $items['ProductMeasureId'];
                    $data->Count = $items['ProductCount'];
                    $data->Summa = $items['ProductSumma'];
                    $data->DeliverySum = $items['ProductDeliverySum'];
                    $all_sum += $data->DeliverySum;
                    $data->VatRate = isset($items['ProductVatRate']) ? $items['ProductVatRate'] : 0;
                    $data->VatSum = isset($items['ProductVatSum']) ? $items['ProductVatSum'] : 0;
//                    var_dump($items);die;

                    if (array_key_exists('CatalogCode', $items)) {
                        $data->CatalogCode = $items['CatalogCode'];
                        $classification = Classifications::find()->where('tin="' . $tin . '" and classCode=' . $items['CatalogCode'])->asArray()->all();
                        if (count($classification) > 0) {
                            $data->CatalogName = $classification[0]['className'];
                        } else {
                            $missing_class_codes[] = $items['CatalogCode'];
                            $_SESSION['missing_classcodes'] = $missing_class_codes;
                            $k--;
                            continue;
                        }
                    } else {
                        $data->CatalogName = $items['ProductCatalogName'];
                        $catalogCode = explode("-", $items['ProductCatalogName']);
                        $data->CatalogCode = trim($catalogCode[0]);
                    }

                    if ($data->VatSum > 0) {
                        $this->HasVat = 1;

                    }

                    $data->DeliverySumWithVat = $items['ProductDeliverySumWithVat'];
                    $data->WithoutVat = $data->VatRate > 0 ? 0 : 1;
                    if (!$data->save()) {
//                        Yii::$app->session->setFlash('danger', 'MAXSULOTLARNI KRITISHDA XATOLIK: ' . Json::encode($data->getErrors()));
//
//                                                var_dump($data->getErrors());die;
                        return false;
                    } else{
//                        var_dump($data->getErrors());die;

                        return true;
                    }
                } else {
                    Yii::$app->session->setFlash('danger', 'Maxsulotlar ustunlari to`liq kiritilmagan');
                    return false;
                }
            }

        } else{
            return true;
        }
    }
}
