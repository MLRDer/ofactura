<?php

namespace common\models;

use cabinet\models\Components;
use PHPUnit\Util\RegularExpressionTest;
use cabinet\classes\consts\ExcelConst as Consts;
use TheSeer\Tokenizer\NamespaceUri;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * This is the model class for table "facturas".
 *
 * @property string $Id ID счета-фактуры
 * @property int $Version Версия JSON-структуры
 * @property int $FacturaType Тип счета-фактуры
 * @property int|null $SingleSidedType Тип одностороннего счета-фактуры
 * @property string $FacturaNo Номер счета-фактуры
 * @property string $FacturaDate Дата счета-фактуры
 * @property string|null $OldFacturaId ID прошлого счета-фактуры
 * @property string|null $OldFacturaNo Номер прошлого счета-фактуры
 * @property string|null $OldFacturaDate Дата прошлого счета-фактуры
 * @property string $ContractNo Номер договора
 * @property string $ContractDate Дата договора
 * @property string|null $AgentFacturaId Уникальный ID  (отличается от FacturaId)
 * @property string|null $EmpowermentNo № доверенности
 * @property string|null $EmpowermentDateOfIssue Дата доверенности
 * @property string|null $AgentFio ФИО доверенного лица
 * @property string|null $AgentTin ИНН доверенного лица
 * @property string|null $ItemReleasedFio ФИО лица, отпустившего товары
 * @property string $SellerTin ИНН поставщика
 * @property string|null $BuyerTin ИНН покупателя
 * @property string $SellerName Наименование 
 * @property string|null $SellerAccount Расчётный счёт
 * @property string|null $SellerBankId МФО обслуживающего банка
 * @property string|null $SellerAddress Адрес
 * @property string|null $SellerMobile Номер мобильного телефона
 * @property string|null $SellerWorkPhone Номер рабочего телефона
 * @property string|null $SellerOked ОКЭД
 * @property string|null $SellerDistrictId ID района
 * @property string|null $SellerDirector ФИО директора
 * @property string|null $SellerAccountant ФИО главного бухгалтера
 * @property string|null $SellerVatRegCode Регистрационный код плательщика НДС
 * @property string|null $SellerBranchCode Код филиала
 * @property string|null $SellerBranchName Название филиала
 * @property string|null $BuyerName Наименование
 * @property string|null $BuyerAccount Расчётный счёт
 * @property string|null $BuyerBankId МФО обслуживающего банка
 * @property string|null $BuyerAddress Адрес
 * @property string|null $BuyerMobile Номер мобильного телефона
 * @property string|null $BuyerWorkPhone Номер рабочего телефона
 * @property string|null $BuyerOked ОКЭД
 * @property string|null $BuyerDistrictId ID района
 * @property string|null $BuyerDirector ФИО директора
 * @property string|null $BuyerAccountant ФИО главного бухгалтера
 * @property string|null $BuyerVatRegCode Регистрационный код плательщика НДС
 * @property string|null $BuyerBranchCode Код филиала
 * @property string|null $BuyerBranchName Название филиала
 * @property string $FacturaProductId ID списка продуктов (работ, услуг)
 * @property string $Tin ИНН поставщика
 * @property int $HasVat В списке товаров имеются позиции с НДС
 * @property int $HasExcise В списке товаров имеются позиции с акцизным налогом
 * @property int $HasCommittent В списке товаров имеются позиции, для которых указан коммитент
 * @property int $HasMedical В списке товаров имеются позиции, для которых указаны
 * @property float|null $AllSum
 * @property float|null $AllVatSum
 * @property int $type
 * @property int $status
 * @property int|null $in_call_back
 * @property string $notes Описания отказа
 * @property string $created_date
 * @property string $json_items
 * @property int|null $reestr_id
 */
class Facturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
//    public $json_items;

    const TYPE_DEFAULT = 0;
    const TYPE_CONSOLE = 3;

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

    public $file;

    public static function tableName()
    {
        return 'facturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'Version', 'FacturaType', 'FacturaNo', 'FacturaDate', 'ContractNo', 'ContractDate', 'SellerTin', 'SellerName', 'FacturaProductId', 'Tin', 'HasVat', 'HasExcise', 'HasCommittent', 'HasMedical', 'type', 'status'], 'required'],
            [['Version', 'FacturaType', 'SingleSidedType', 'HasVat', 'HasExcise', 'HasCommittent', 'HasMedical', 'type', 'status','in_call_back','reestr_id'], 'integer'],
            [['FacturaDate', 'ContractDate', 'EmpowermentDateOfIssue','json_items','OldFacturaDate','notes','created_date'], 'safe'],
            [['AllSum', 'AllVatSum'], 'number'],
            [['Id', 'AgentFacturaId', 'FacturaProductId','OldFacturaId'], 'string', 'max' => 24],
            [['FacturaNo','OldFacturaNo', 'ContractNo', 'EmpowermentNo', 'AgentFio', 'ItemReleasedFio', 'SellerName', 'SellerAccount', 'SellerAddress', 'SellerMobile', 'SellerWorkPhone', 'SellerOked', 'SellerDirector', 'SellerAccountant', 'SellerBranchName', 'BuyerName', 'BuyerAccount', 'BuyerAddress', 'BuyerMobile', 'BuyerWorkPhone', 'BuyerOked'], 'string', 'max' => 1000],
            [['AgentTin', 'SellerTin', 'BuyerTin', 'Tin'], 'string', 'max' => 9],
            [['SellerBankId', 'BuyerBankId'], 'string', 'max' => 5],
            [['SellerDistrictId', 'BuyerDistrictId'], 'string', 'max' => 4],
            [['SellerVatRegCode', 'BuyerVatRegCode'], 'string', 'max' => 12],
            [['SellerBranchCode', 'BuyerBranchCode'], 'string', 'max' => 255],
            [['BuyerDirector'], 'string', 'max' => 550],
            [['BuyerAccountant', 'BuyerBranchName'], 'string', 'max' => 500],
            ['file', 'file', 'extensions' => 'xlsx'],
            [['Id'], 'unique'],
        ];
    }

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


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {


        return [
            'Id' => Yii::t('main', 'ID счета-фактуры'),
            'Version' => Yii::t('main', 'Версия JSON-структуры'),
            'FacturaType' => Yii::t('main', 'Тип счета-фактуры'),
            'SingleSidedType' => Yii::t('main', 'Тип одностороннего счета-фактуры'),
            'FacturaNo' => Yii::t('main', 'Номер счета-фактуры'),
            'FacturaDate' => Yii::t('main', 'Дата счета-фактуры'),
            'ContractNo' => Yii::t('main', 'Номер договора'),
            'OldFacturaId' => Yii::t('main', 'ID прошлого счета-фактуры'),
            'OldFacturaNo' => Yii::t('main', 'Номер прошлого счета-фактуры'),
            'OldFacturaDate' => Yii::t('main', 'Дата прошлого счета-фактуры'),
            'ContractDate' => Yii::t('main', 'Дата договора'),
            'AgentFacturaId' => Yii::t('main', 'Уникальный ID  (отличается от FacturaId)'),
            'EmpowermentNo' => Yii::t('main', '№ доверенности'),
            'EmpowermentDateOfIssue' => Yii::t('main', 'Дата доверенности'),
            'AgentFio' => Yii::t('main', 'ФИО доверенного лица'),
            'AgentTin' => Yii::t('main', 'ИНН доверенного лица'),
            'ItemReleasedFio' => Yii::t('main', 'ФИО лица, отпустившего товары'),
            'SellerTin' => Yii::t('main', 'ИНН поставщика'),
            'BuyerTin' => Yii::t('main', 'ИНН покупателя'),
            'SellerName' => Yii::t('main', 'Наименование '),
            'SellerAccount' => Yii::t('main', 'Расчётный счёт'),
            'SellerBankId' => Yii::t('main', 'МФО обслуживающего банка'),
            'SellerAddress' => Yii::t('main', 'Адрес'),
            'SellerMobile' => Yii::t('main', 'Номер мобильного телефона'),
            'SellerWorkPhone' => Yii::t('main', 'Номер рабочего телефона'),
            'SellerOked' => Yii::t('main', 'ОКЭД'),
            'SellerDistrictId' => Yii::t('main', 'ID района'),
            'SellerDirector' => Yii::t('main', 'ФИО директора'),
            'SellerAccountant' => Yii::t('main', 'ФИО главного бухгалтера'),
            'SellerVatRegCode' => Yii::t('main', 'Регистрационный код плательщика НДС'),
            'SellerBranchCode' => Yii::t('main', 'Код филиала'),
            'SellerBranchName' => Yii::t('main', 'Название филиала'),
            'BuyerName' => Yii::t('main', 'Наименование '),
            'BuyerAccount' => Yii::t('main', 'Расчётный счёт'),
            'BuyerBankId' => Yii::t('main', 'МФО обслуживающего банка'),
            'BuyerAddress' => Yii::t('main', 'Адрес'),
            'BuyerMobile' => Yii::t('main', 'Номер мобильного телефона'),
            'BuyerWorkPhone' => Yii::t('main', 'Номер рабочего телефона'),
            'BuyerOked' => Yii::t('main', 'ОКЭД'),
            'BuyerDistrictId' => Yii::t('main', 'ID района'),
            'BuyerDirector' => Yii::t('main', 'ФИО директора'),
            'BuyerAccountant' => Yii::t('main', 'ФИО главного бухгалтера'),
            'BuyerVatRegCode' => Yii::t('main', 'Регистрационный код плательщика НДС'),
            'BuyerBranchCode' => Yii::t('main', 'Код филиала'),
            'BuyerBranchName' => Yii::t('main', 'Название филиала'),
            'FacturaProductId' => Yii::t('main', 'ID списка продуктов (работ, услуг)'),
            'Tin' => Yii::t('main', 'ИНН поставщика'),
            'HasVat' => Yii::t('main', 'В списке товаров имеются позиции с НДС'),
            'HasExcise' => Yii::t('main', 'В списке товаров имеются позиции с акцизным налогом'),
            'HasCommittent' => Yii::t('main', 'В списке товаров имеются позиции, для которых указан коммитент'),
            'HasMedical' => Yii::t('main', 'В списке товаров имеются позиции, для которых указаны'),
            'AllSum' => Yii::t('main', 'All Sum'),
            'AllVatSum' => Yii::t('main', 'All Vat Sum'),
            'type' => Yii::t('main', 'Type'),
            'status' => Yii::t('main', 'Status'),
        ];
    }

    public  function GetJsonData(){
        $model = $this;
        $factura_id = $this->Id;
        $data = [
            "Version"=>$model->Version,
            "FacturaType"=>(string)$model->FacturaType,
            "SingleSidedType"=>$model->SingleSidedType!=null?$model->SingleSidedType:0,
            "FacturaId"=>$factura_id,
            "FacturaDoc"=>[
                "FacturaNo"=>$model->FacturaNo,
                "FacturaDate"=>$model->FacturaDate
            ],
//            "OldFacturaDoc"=>[
//                "OldFacturaId"=>$model->OldFacturaId,
//                "OldFacturaNo"=>$model->OldFacturaNo,
//                "OldFacturaDate"=>$model->OldFacturaDate
//            ],
            "ContractDoc"=>[
                "ContractNo"=>$model->ContractNo,
                "ContractDate"=>$model->ContractDate
            ],
            "FacturaEmpowermentDoc"=>[
                "AgentFacturaId"=>$model->AgentFacturaId,
                "EmpowermentNo"=>$model->EmpowermentNo,
                "EmpowermentDateOfIssue"=>$model->EmpowermentDateOfIssue,
                "AgentTin"=>$model->AgentTin,
//                "AgentPinfl"=>$model->Age
            ],
            "ItemReleasedDoc"=>[
//                "ItemReleasedTin"=>$model->It,
                "ItemReleasedFio"=>$model->ItemReleasedFio,
//                "ItemReleasedPinfl"=>""
            ],
            "SellerTin"=>$model->SellerTin,
            "BuyerTin"=>$model->BuyerTin,
            "Seller"=>[
                "Name"=>$model->SellerName,
                "Account"=>$model->SellerAccount,
                "BankId"=>$model->SellerBankId,
                "Address"=>$model->SellerAddress,
                "Mobile"=>$model->SellerMobile,
                "WorkPhone"=>$model->SellerWorkPhone,
                "Oked"=>$model->SellerOked,
                "DistrictId"=>$model->SellerDistrictId,
                "Director"=>$model->SellerDirector,
                "Accountant"=>$model->SellerAccountant,
                "VatRegCode"=>$model->SellerVatRegCode,
                "BranchCode"=>$model->SellerBranchCode,
                "BranchName"=>$model->SellerBranchName
            ],
            "Buyer"=>[
                "Name"=>$model->BuyerName,
                "Account"=>$model->BuyerAccount,
                "BankId"=>$model->BuyerBankId,
                "Address"=>$model->BuyerAddress,
                "Mobile"=>$model->BuyerMobile,
                "WorkPhone"=>$model->BuyerWorkPhone,
                "Oked"=>$model->BuyerOked,
                "DistrictId"=>$model->BuyerDistrictId,
                "Director"=>$model->BuyerDirector,
                "Accountant"=>$model->BuyerAccountant,
                "VatRegCode"=>$model->BuyerVatRegCode,
                "BranchCode"=>$model->BuyerBranchCode,
                "BranchName"=>$model->BuyerBranchName
            ],
//            "ForeignCompany"=>[
//                "CountryId"=>"",
//                "Name"=>"",
//                "Address"=>"",
//                "Bank"=>"",
//                "Account"=>""
//            ],

            "ProductList"=>[
                "FacturaProductId"=>$model->FacturaProductId,
                "Tin"=>$model->Tin,
                "HasExcise"=>$model->HasExcise==1?true:false,
                "HasVat"=>$model->HasVat==1?true:false,
                "HasCommittent"=>$model->HasCommittent==1?true:false,
                "HasMedical"=>$model->HasMedical==1?true:false,
                "Products"=> $this->GetProducts($factura_id)
            ]
        ];
        return $data;
    }

    public function GetProducts($factura_id){
        $model = FacturaProducts::find()->andWhere(['FacturaId'=>$factura_id])->orderBy("OrdNo ASC")->all();
        $data = [];
        foreach ($model as $items){
            $data[]=[
                "OrdNo"=>$items->OrdNo,
                "CommittentName"=>$items->CommittentName,
                "CommittentTin"=>$items->CommittentTin,
                "CommittentVatRegCode"=>$items->CommittentVatRegCode,
                "Name"=>$items->Name,
                "Serial"=>$items->Serial,
                "CatalogCode"=>$items->CatalogCode,
                "CatalogName"=>$items->CatalogName,
                "MeasureId"=>$items->MeasureId,
                "BaseSumma"=>$items->BaseSumma,
                "ProfitRate"=>$items->ProfitRate,
                "Count"=>$items->Count,
                "Summa"=>$items->Summa,
                "DeliverySum"=>$items->DeliverySum,
                "ExciseRate"=>$items->ExciseRate,
                "ExciseSum"=>$items->ExciseSum,
                "VatRate"=>$items->VatRate,
                "VatSum"=>$items->VatSum,
                "DeliverySumWithVat"=>$items->DeliverySumWithVat,
                "WithoutVat"=>$items->WithoutVat==1?true:false
            ];
        }
        return $data;
    }

    public function SendData($factura_id){

    }

    public function SetFacturasParams($factura_type,$tin,$has_vat=0,$has_exciese=1,$has_committent=0,$has_medical=0){
        $this->Version = 1;
        $this->FacturaType = $factura_type;
        $this->Id = Components::getFacturaID();
        $this->FacturaProductId = Components::getFacturaID();
        $this->Tin = (string)$tin;
        $this->HasVat = 0;
        $this->status = Facturas::STATUS_NEW;
        $this->type = Facturas::TYPE_DEFAULT;
        $this->HasExcise = 0;
        $this->HasCommittent = $has_committent;
        $this->HasMedical = $has_medical;
    }


    public function SetSellerData($companyData){
        $acountant = CompanyInvoicesHelpers::findOne(['company_id'=>Components::GetId()]);
        $accountant_num = "";
        $mfo = "";
        if(!empty($acountant)){
            $accountant_num = $acountant->invoices_number;
            $mfo =$acountant->mfo;
        }
        $this->SellerTin = (string)$companyData->tin;
        $this->SellerName = $companyData->name;
        $this->SellerBankId = $mfo;
        $this->SellerAccount = $accountant_num;
        $this->SellerDirector = $companyData->director;
        $this->SellerAccountant = $companyData->accountant;
        $this->SellerAddress = $companyData->address;
        $this->SellerOked= (string)$companyData->oked;
        if($companyData->reg_code==null){
            $nds =Components::getNdsCode($companyData->tin,'regCode');
            $this->SellerVatRegCode = $nds['result'];
        } else{
            $this->SellerVatRegCode = $companyData->reg_code;
        }

    }

    public function InsertByArray($data){
        $this->Id = $data['FACTURAID'];
        $this->Version = isset($data['VERSION'])?$data['VERSION']:"1";
        $this->FacturaType = isset($data['FACTURATYPE'])?$data['FACTURATYPE']:0;
        $this->SingleSidedType = isset($data['SINGLESIDEDTYPE'])?$data['SINGLESIDEDTYPE']:null;
        $this->FacturaNo = $data['FACTURADOC']['FACTURANO'];
        $this->FacturaDate = date("Y-m-d",strtotime($data['FACTURADOC']['FACTURADATE']));
        $this->ContractNo = $data['CONTRACTDOC']['CONTRACTNO'];
        $this->ContractDate = date("Y-m-d",strtotime($data['CONTRACTDOC']['CONTRACTDATE']));
        $this->AgentFacturaId = isset($data['FACTURAEMPOWERMENTDOC']['AGENTFACTURAID'])?$data['FACTURAEMPOWERMENTDOC']['AGENTFACTURAID']:null;
        $this->EmpowermentNo = isset($data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTNO'])?$data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTNO']:null;
        $this->EmpowermentDateOfIssue= isset($data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTDATEOFISSUE'])?date("Y-m-d",strtotime($data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTDATEOFISSUE'])):null;
        $this->AgentFio = isset($data['FACTURAEMPOWERMENTDOC']['AGENTFIO'])?$data['FACTURAEMPOWERMENTDOC']['AGENTFIO']:null;
        $this->AgentTin= isset($data['FACTURAEMPOWERMENTDOC']['AGENTTIN'])?$data['FACTURAEMPOWERMENTDOC']['AGENTTIN']:null;
        if(isset($data['OLDFACTURADOC'])) {
            $this->OldFacturaId = isset($data['OLDFACTURADOC']['OLDFACTURAID'])?$data['OLDFACTURADOC']['OLDFACTURAID']:null;
            $this->OldFacturaNo = isset($data['OLDFACTURADOC']['OLDFACTURANO'])?$data['OLDFACTURADOC']['OLDFACTURANO']:null;
            $this->OldFacturaDate = isset($data['OLDFACTURADOC']['OLDFACTURADATE'])?date("Y-m-d H:i:s",strtotime($data['OLDFACTURADOC']['OLDFACTURADATE'])):null;
        }
        $this->ItemReleasedFio = $data['ITEMRELEASEDDOC']['ITEMRELEASEDFIO'];
        $this->SellerTin = $data['SELLERTIN'];
        $this->BuyerTin = isset($data['BUYERTIN'])?$data['BUYERTIN']:null;
        $this->SellerName = $data['SELLER']['NAME'];
        $this->SellerAccount = isset($data['SELLER']['ACCOUNT'])?$data['SELLER']['ACCOUNT']:null;
        $this->SellerBankId = isset($data['SELLER']['BANKID'])?$data['SELLER']['BANKID']:null;
        $this->SellerAddress = isset($data['SELLER']['ADDRESS'])?$data['SELLER']['ADDRESS']:null;
        $this->SellerMobile = isset($data['SELLER']['MOBILE'])?$data['SELLER']['MOBILE']:null;
        $this->SellerWorkPhone = isset($data['SELLER']['WORKPHONE'])?$data['SELLER']['WORKPHONE']:null;
        $this->SellerOked = isset($data['SELLER']['OKED'])?$data['SELLER']['OKED']:null;
        $this->SellerDistrictId = isset($data['SELLER']['DISTRICTID'])?$data['SELLER']['DISTRICTID']:null;
        $this->SellerDirector = isset($data['SELLER']['DIRECTOR'])?$data['SELLER']['DIRECTOR']:null;
        $this->SellerAccountant = isset($data['SELLER']['ACCOUNTANT'])?$data['SELLER']['ACCOUNTANT']:null;
        $this->SellerVatRegCode = isset($data['SELLER']['VATREGCODE'])?$data['SELLER']['VATREGCODE']:null;
        $this->SellerBranchName = isset($data['SELLER']['BRANCHCODE'])?$data['SELLER']['BRANCHCODE']:null;
        $this->SellerBranchCode = isset($data['SELLER']['BRANCHNAME'])?$data['SELLER']['BRANCHNAME']:null;

        $this->BuyerName = isset($data['BUYER']['NAME'])?$data['BUYER']['NAME']:null;
        $this->BuyerAccount = isset($data['BUYER']['ACCOUNT'])?$data['BUYER']['ACCOUNT']:null;
        $this->BuyerBankId = isset($data['BUYER']['BANKID'])?$data['BUYER']['BANKID']:null;
        $this->BuyerAddress = isset($data['BUYER']['ADDRESS'])?$data['BUYER']['ADDRESS']:null;
        $this->BuyerMobile = isset($data['BUYER']['MOBILE'])?$data['BUYER']['MOBILE']:null;
        $this->BuyerWorkPhone = isset($data['BUYER']['WORKPHONE'])?$data['BUYER']['WORKPHONE']:null;
        $this->BuyerOked = isset($data['BUYER']['OKED'])?$data['BUYER']['OKED']:null;
        $this->BuyerDistrictId = isset($data['BUYER']['DISTRICTID'])?$data['BUYER']['DISTRICTID']:null;
        $this->BuyerDirector = isset($data['BUYER']['DIRECTOR'])?$data['BUYER']['DIRECTOR']:null;
        $this->BuyerAccountant = isset($data['BUYER']['ACCOUNTANT'])?$data['BUYER']['ACCOUNTANT']:null;
        $this->BuyerVatRegCode = isset($data['BUYER']['VATREGCODE'])?$data['BUYER']['VATREGCODE']:null;
        $this->BuyerBranchName = isset($data['BUYER']['BRANCHCODE'])?$data['BUYER']['BRANCHCODE']:null;
        $this->BuyerBranchCode = isset($data['BUYER']['BRANCHNAME'])?$data['BUYER']['BRANCHNAME']:null;
        $this->FacturaProductId = $data['PRODUCTLIST']['FACTURAPRODUCTID'];
        $this->Tin = $data['PRODUCTLIST']['TIN'];
        $this->HasExcise = isset($data['PRODUCTLIST']['HASEXCISE'])?(int)$data['PRODUCTLIST']['HASEXCISE']:0;
        $this->HasVat = isset($data['PRODUCTLIST']['HASVAT']) ?(int)$data['PRODUCTLIST']['HASVAT']:0;
        $this->HasMedical = isset($data['PRODUCTLIST']['HASMEDICAL'])?(int)$data['PRODUCTLIST']['HASMEDICAL']:0;
        $this->HasCommittent = isset($data['PRODUCTLIST']['HASCOMMITTENT'])?(int)$data['PRODUCTLIST']['HASCOMMITTENT']:0;
        $this->type = 1;
        $this->status = 15;
        $this->notes = isset($data['NOTES'])?$data['NOTES']:null;
//        echo $data;
    }

    public function InsertByConsole($data){
        $this->Id = $data['FACTURAID'];
        $this->Version = isset($data['VERSION'])?$data['VERSION']:"1";
        $this->FacturaType = isset($data['FACTURATYPE'])?$data['FACTURATYPE']:0;
        $this->SingleSidedType = isset($data['SINGLESIDEDTYPE'])?$data['SINGLESIDEDTYPE']:null;
        $this->FacturaNo = $data['FACTURADOC']['FACTURANO'];
        $this->FacturaDate = date("Y-m-d",strtotime($data['FACTURADOC']['FACTURADATE']));
        $this->ContractNo = $data['CONTRACTDOC']['CONTRACTNO'];
        $this->ContractDate = date("Y-m-d",strtotime($data['CONTRACTDOC']['CONTRACTDATE']));
        $this->AgentFacturaId = isset($data['FACTURAEMPOWERMENTDOC']['AGENTFACTURAID'])?$data['FACTURAEMPOWERMENTDOC']['AGENTFACTURAID']:null;
        $this->EmpowermentNo = isset($data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTNO'])?$data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTNO']:null;
        $this->EmpowermentDateOfIssue= isset($data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTDATEOFISSUE'])?date("Y-m-d",strtotime($data['FACTURAEMPOWERMENTDOC']['EMPOWERMENTDATEOFISSUE'])):null;
        $this->AgentFio = isset($data['FACTURAEMPOWERMENTDOC']['AGENTFIO'])?$data['FACTURAEMPOWERMENTDOC']['AGENTFIO']:null;
        $this->AgentTin= isset($data['FACTURAEMPOWERMENTDOC']['AGENTTIN'])?$data['FACTURAEMPOWERMENTDOC']['AGENTTIN']:null;
        if(isset($data['OLDFACTURADOC'])) {
            $this->OldFacturaId = isset($data['OLDFACTURADOC']['OLDFACTURAID'])?$data['OLDFACTURADOC']['OLDFACTURAID']:null;
            $this->OldFacturaNo = isset($data['OLDFACTURADOC']['OLDFACTURANO'])?$data['OLDFACTURADOC']['OLDFACTURANO']:null;
            $this->OldFacturaDate = isset($data['OLDFACTURADOC']['OLDFACTURADATE'])?date("Y-m-d H:i:s",strtotime($data['OLDFACTURADOC']['OLDFACTURADATE'])):null;
        }
        $this->ItemReleasedFio = $data['ITEMRELEASEDDOC']['ITEMRELEASEDFIO'];
        $this->SellerTin = $data['SELLERTIN'];
        $this->BuyerTin = isset($data['BUYERTIN'])?$data['BUYERTIN']:null;
        $this->SellerName = $data['SELLER']['NAME'];
        $this->SellerAccount = isset($data['SELLER']['ACCOUNT'])?$data['SELLER']['ACCOUNT']:null;
        $this->SellerBankId = isset($data['SELLER']['BANKID'])?$data['SELLER']['BANKID']:null;
        $this->SellerAddress = isset($data['SELLER']['ADDRESS'])?$data['SELLER']['ADDRESS']:null;
        $this->SellerMobile = isset($data['SELLER']['MOBILE'])?$data['SELLER']['MOBILE']:null;
        $this->SellerWorkPhone = isset($data['SELLER']['WORKPHONE'])?$data['SELLER']['WORKPHONE']:null;
        $this->SellerOked = isset($data['SELLER']['OKED'])?$data['SELLER']['OKED']:null;
        $this->SellerDistrictId = isset($data['SELLER']['DISTRICTID'])?$data['SELLER']['DISTRICTID']:null;
        $this->SellerDirector = isset($data['SELLER']['DIRECTOR'])?$data['SELLER']['DIRECTOR']:null;
        $this->SellerAccountant = isset($data['SELLER']['ACCOUNTANT'])?$data['SELLER']['ACCOUNTANT']:null;
        $this->SellerVatRegCode = isset($data['SELLER']['VATREGCODE'])?$data['SELLER']['VATREGCODE']:null;
        $this->SellerBranchName = isset($data['SELLER']['BRANCHCODE'])?$data['SELLER']['BRANCHCODE']:null;
        $this->SellerBranchCode = isset($data['SELLER']['BRANCHNAME'])?$data['SELLER']['BRANCHNAME']:null;

        $this->BuyerName = isset($data['BUYER']['NAME'])?$data['BUYER']['NAME']:null;
        $this->BuyerAccount = isset($data['BUYER']['ACCOUNT'])?$data['BUYER']['ACCOUNT']:null;
        $this->BuyerBankId = isset($data['BUYER']['BANKID'])?$data['BUYER']['BANKID']:null;
        $this->BuyerAddress = isset($data['BUYER']['ADDRESS'])?$data['BUYER']['ADDRESS']:null;
        $this->BuyerMobile = isset($data['BUYER']['MOBILE'])?$data['BUYER']['MOBILE']:null;
        $this->BuyerWorkPhone = isset($data['BUYER']['WORKPHONE'])?$data['BUYER']['WORKPHONE']:null;
        $this->BuyerOked = isset($data['BUYER']['OKED'])?$data['BUYER']['OKED']:null;
        $this->BuyerDistrictId = isset($data['BUYER']['DISTRICTID'])?$data['BUYER']['DISTRICTID']:null;
        $this->BuyerDirector = isset($data['BUYER']['DIRECTOR'])?$data['BUYER']['DIRECTOR']:null;
        $this->BuyerAccountant = isset($data['BUYER']['ACCOUNTANT'])?$data['BUYER']['ACCOUNTANT']:null;
        $this->BuyerVatRegCode = isset($data['BUYER']['VATREGCODE'])?$data['BUYER']['VATREGCODE']:null;
        $this->BuyerBranchName = isset($data['BUYER']['BRANCHCODE'])?$data['BUYER']['BRANCHCODE']:null;
        $this->BuyerBranchCode = isset($data['BUYER']['BRANCHNAME'])?$data['BUYER']['BRANCHNAME']:null;

        $this->FacturaProductId = $data['FACTURAPRODUCTID'];
        $this->notes = $data['NOTES'];
        $this->status = $data['CURRENTSTATEID'];
        $this->created_date = date('Y-m-d H:i:s',strtotime($data['CREATED']));
        $this->type = self::TYPE_CONSOLE;
        $products = Facturas::GetProductsIsRouming($this->FacturaProductId,$this->SellerTin);
        if(isset($products['facturaProductId'])) {
            $this->Tin = $products['tin'];
            $this->HasCommittent = (int)$products['hasCommittent'];
            $this->HasMedical = (int)$products['hasMedical'];
            $this->HasExcise = (int)$products['hasExcise'];
            $this->HasVat = (int)$products['hasVat'];
            $this->HasCommittent = (int)$products['hasCommittent'];
            FacturaProducts::deleteAll(['FacturaId' => $this->Id]);
            foreach ($products['products'] as $itemsProducts){
                $dataProducts = new FacturaProducts();
                $dataProducts->FacturaId = $this->Id;
                $dataProducts->OrdNo = (string)$itemsProducts['ordNo'];
                $dataProducts->CommittentName = $itemsProducts['committentName'];
                $dataProducts->CommittentTin = $itemsProducts['committentTin'];
                $dataProducts->CommittentVatRegCode = $itemsProducts['committentVatRegCode'];
                $dataProducts->Name = $itemsProducts['name'];
                $dataProducts->Serial= $itemsProducts['serial'];
                 

                //var_dump($catalogCode);die;
                $dataProducts->CatalogCode= $itemsProducts['catalogCode'];
                $dataProducts->CatalogName= $itemsProducts['catalogName'];
                $dataProducts->MeasureId = $itemsProducts['measureId'];
                $dataProducts->BaseSumma = $itemsProducts['baseSumma'];
                $dataProducts->ProfitRate = $itemsProducts['profitRate'];
                $dataProducts->Summa = $itemsProducts['summa'];
                $dataProducts->Count = $itemsProducts['count'];
                $dataProducts->DeliverySum = $itemsProducts['deliverySum'];
                $dataProducts->ExciseRate = $itemsProducts['exciseRate'];
                $dataProducts->ExciseRate = $itemsProducts['exciseSum'];
                $dataProducts->WithoutVat = (int)$itemsProducts['withoutVat'];
                $dataProducts->VatRate = $itemsProducts['vatRate'];
                $dataProducts->VatSum = $itemsProducts['vatSum'];
                $dataProducts->DeliverySumWithVat = $itemsProducts['deliverySumWithVat'];
                if($dataProducts->save()){
                    echo "Tovarlar saqlandi!\n";
                } else {
                    echo "Eror products:".Json::encode($dataProducts->getErrors())." \n";
                    exit;
                }
            }
        }
    }

    public static function GetProductsIsRouming($productId,$tin){
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            )
        );
        $context = stream_context_create($opts);
        $url = Yii::$app->params['factura_host']."/provider/api/uz/{$tin}/facturas/productlist/".$productId;
        $data = file_get_contents($url, false, $context);
        return Json::decode($data);
    }

    public function InsertFacturaProducts($dataObj){
        $model = $dataObj['PRODUCTLIST']['PRODUCTS'];
        FacturaProducts::deleteAll(['FacturaId' => $this->Id]);
        $k=0;
        $all_sum = 0;
        $all_sum_vat = 0;
        foreach ($model as $items) {
            $k++;
                $data = new FacturaProducts();
                $data->FacturaId = $dataObj['FACTURAID'];
                $data->OrdNo = isset($items['ORDNO'])?(string)$items['ORDNO']:(string)$k;
                if(isset($items['COMMITTENTNAME'])) {
                    $data->CommittentName = $items['COMMITTENTNAME'];
                    $data->CommittentTin = $items['COMMITTENTTIN'];
                    $data->CommittentVatRegCode = $items['COMMITTENTVATREGCODE'];
                }
                $data->Name =$items['NAME'];
                $data->Serial =isset($items['SERIAL'])?$items['SERIAL']:null;
                $data->MeasureId = $items['MEASUREID'];
                $data->BaseSumma = isset($items['BASESUMMA'])?$items['BASESUMMA']:null;
                $data->ProfitRate = isset($items['PROFITRATE'])?$items['PROFITRATE']:null;
                $data->Count = isset($items['COUNT'])?$items['COUNT']:0;
                $data->Summa = $items['SUMMA'];
                $data->DeliverySum = $items['DELIVERYSUM'];
                if (isset($items['CATALOGCODE'])) {
                    $data->CatalogCode = $items['CATALOGCODE'];
                }
                if (isset($items['CATALOGNAME'])) {
                    $data->CatalogName = $items['CATALOGNAME'];
                }
                if (isset($items['EXCISERATE'])) {
                    $data->ExciseRate = $items['EXCISERATE'];
                    $data->ExciseSum = isset($items['EXCISESUM'])?$items['EXCISESUM']:0;
                    $all_sum_vat +=$data->ExciseSum;
                }
                $data->DeliverySumWithVat = $items['DELIVERYSUMWITHVAT'];
                $all_sum +=$data->DeliverySumWithVat;
                if(isset($items['VATRATE'])) {
                    $data->VatRate = $items['VATRATE'];
                    $data->VatSum = isset($items['VATSUM'])?$items['VATSUM']:0;
                    $all_sum_vat +=$data->VatSum;
                }
                $data->WithoutVat = isset($items['WITHOUTVAT'])?(int)$items['WITHOUTVAT']:0;
                if(!$data->save()){
                    echo Json::encode($data->getErrors());
                }

        }
        $this->AllSum = $all_sum;
        $this->AllVatSum = $all_sum_vat;
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
        if(!$this->isNewRecord && $this->status==Facturas::STATUS_DUBL) {
            $this->status = Facturas::STATUS_NEW;
        }
        // If new record qila olmaymiz sababi update bo`lgandaxam o`zgartrishimiz kerak. shuning uchun statusni tekshirayapmiz
        if($this->status==Facturas::STATUS_NEW) {
            $model = Json::decode($this->json_items);
            FacturaProducts::deleteAll(['FacturaId' => $this->Id]);
            $k=0;
            $all_sum = 0;
            $all_sum_vat = 0;
            $missing_class_codes = [];
            foreach ($model as $items) {
                if (isset($items['ProductName']) &&
                    isset($items['ProductSumma']) &&
                    isset($items['ProductMeasureId']) &&
                    isset($items['ProductCount']) &&
                    isset($items['ProductDeliverySum']) &&
                    (array_key_exists('ProductCatalogName', $items) || array_key_exists('CatalogCode', $items))

                ) {
                    $tin = Components::CompanyData('tin');
//                    var_dump($items);
//                    die();
                    $k++;
                    $data = new FacturaProducts();
                    $data->FacturaId = $this->Id;
                    $data->OrdNo = (string)$k;
                    $data->Name =$items['ProductName'];
                    $data->MeasureId = $items['ProductMeasureId'];
                    $data->Count = $items['ProductCount'];
                    $data->Summa = $items['ProductSumma'];
                    $data->DeliverySum = $items['ProductDeliverySum'];
                    $all_sum +=$data->DeliverySum;
                    $data->VatRate = isset($items['ProductVatRate'])?$items['ProductVatRate']:0;
                    $data->VatSum = isset($items['ProductVatSum'])?$items['ProductVatSum']:0;
//                    var_dump($items);die;

                    if (array_key_exists('CatalogCode', $items)){
                        $data->CatalogCode = $items['CatalogCode'];
                        $classification = Classifications::find()->where('tin="'.$tin.'" and classCode='.$items['CatalogCode'])->asArray()->all();
                        if (count($classification)>0){
                            $data->CatalogName = $classification[0]['className'];
                        }
                        else{
                            $missing_class_codes[]=$items['CatalogCode'];
                            $_SESSION['missing_classcodes'] = $missing_class_codes;
                            $k--;
                            continue;
                        }
                    }
                    else{
                        $data->CatalogName= $items['ProductCatalogName'];
                        $catalogCode = explode("-",$items['ProductCatalogName']);
                        $data->CatalogCode = trim($catalogCode[0]);
                    }

                    if($data->VatSum>0){
                        $this->HasVat = 1;

                    }
                    if(isset($items['ProductFuelSum']) && $items['ProductFuelSum']>0) {
                        $data->ExciseRate = isset($items['ProductFuelRate']) ? $items['ProductFuelRate'] : 0;
                        $data->ExciseSum = isset($items['ProductFuelSum']) ? $items['ProductFuelSum'] : 0;
                        $this->HasExcise = 1;
                    }
                    $data->DeliverySumWithVat = $items['ProductDeliverySumWithVat'];
                    $all_sum_vat +=$data->DeliverySumWithVat;
                    $data->WithoutVat = $data->VatRate>0?0:1;
                    if(!$data->save()){
                        Yii::$app->session->setFlash('danger', 'MAXSULOTLARNI KRITISHDA XATOLIK: '.Json::encode($data->getErrors()));
                        return false;
                    }
                } else {
                    Yii::$app->session->setFlash('danger', 'Maxsulotlar ustunlari to`liq kiritilmagan');
                    return false;
                }
            }
            $this->AllSum = $all_sum;
            $this->AllVatSum = $all_sum_vat;
        }



        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
