<?php

namespace common\models;

use cabinet\models\Components;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "acts".
 *
 * @property string $Id
 * @property string $ActNo
 * @property string $ActDate
 * @property string $ActText
 * @property string $ContractNo
 * @property string $ContractDate
 * @property string $SellerTin
 * @property string $SellerName
 * @property string $BuyerTin
 * @property string $BuyerName
 * @property string $ActProductId
 * @property string $Tin
 * @property string $notes
 * @property int $status
 * @property int|null $type
 * @property string $created_date
 * @property string $json_items
 */
class Acts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const TYPE_MANUAL = 1;
    const TYPE_CALLBACK = 2;
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


    public static function tableName()
    {
        return 'acts';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'ActNo', 'ActDate', 'ActText', 'ContractNo', 'ContractDate', 'SellerTin', 'SellerName', 'BuyerTin', 'BuyerName', 'ActProductId', 'Tin', 'status', 'created_date'], 'required'],
            [['ActDate', 'ContractDate', 'created_date'], 'safe'],
            [['status', 'type'], 'integer'],
            [['Id', 'ActProductId'], 'string', 'max' => 50],
            [['json_items','ActText','notes'], 'string'],
            [['ActNo', 'ContractNo', 'SellerName', 'BuyerName'], 'string', 'max' => 1000],
            [['SellerTin', 'BuyerTin', 'Tin'], 'string', 'max' => 9],
            [['Id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('main', 'ID'),
            'ActNo' => Yii::t('main', 'ActNo'),
            'ActDate' => Yii::t('main', 'ActDate'),
            'ActText' => Yii::t('main', 'Act Text'),
            'ContractNo' => Yii::t('main', 'ContractNo'),
            'ContractDate' => Yii::t('main', 'ContractDate'),
            'SellerTin' => Yii::t('main', 'Seller Tin'),
            'SellerName' => Yii::t('main', 'Seller Name'),
            'BuyerTin' => Yii::t('main', 'Buyer Tin'),
            'BuyerName' => Yii::t('main', 'Buyer Name'),
            'ActProductId' => Yii::t('main', 'Act Product ID'),
            'Tin' => Yii::t('main', 'Tin'),
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

    public  function GetJsonData(){
        $model = $this;
        $act_id = $this->Id;
        $data = [
            "ActId"=>$act_id,
            "ActDoc"=>[
                "ActNo"=>$model->ActNo,
                "ActDate"=>$model->ActDate,
                "ActText"=>$model->ActText
            ],
            "ContractDoc"=>[
                "ContractNo"=>$model->ContractNo,
                "ContractDate"=>$model->ContractDate
            ],
            "SellerTin"=>$model->SellerTin,
            "SellerName"=>$model->SellerName,
            "BuyerTin"=>$model->BuyerTin,
            "BuyerName"=>$model->BuyerName,

            "ProductList"=>[
                "ActProductId"=>$model->ActProductId,
                "Tin"=>$model->Tin,
                "Products"=> $this->GetProducts($act_id)
            ]
        ];
        return $data;
    }

    public function GetProducts($act_id){
        $model = ActProducts::find()->andWhere(['act_id'=>$act_id])->orderBy("OrdNo ASC")->all();
        $data = [];
        foreach ($model as $items){
            $data[]=[
                "OrdNo"=>$items->OrdNo,
                "Name"=>$items->Name,
                "MeasureId"=>$items->MeasureId,
                "Summa"=>$items->Summa,
                "Count"=>$items->Count,
                "TotalSum"=>$items->TotalSum,

            ];
        }
        return $data;
    }

    public function InsertByArray($data){
        $this->Id = $data['ACTID'];
        $this->ActNo = $data['ACTDOC']['ACTNO'];
        $this->ActText = $data['ACTDOC']['ACTTEXT'];
        $this->ActDate = date("Y-m-d",strtotime($data['ACTDOC']['ACTDATE']));
        $this->ContractNo = $data['CONTRACTDOC']['CONTRACTNO'];
        $this->ContractDate = date("Y-m-d",strtotime($data['CONTRACTDOC']['CONTRACTDATE']));
        $this->SellerTin = $data['SELLERTIN'];
        $this->BuyerTin = isset($data['BUYERTIN'])?$data['BUYERTIN']:null;

        $this->SellerName = $data['SELLERNAME'];
        $this->BuyerName = isset($data['BUYERNAME'])?$data['BUYERNAME']:null;
        $this->Tin = $data['PRODUCTLIST']['TIN'];
        $this->created_date = date('Y-m-d H:i:s');
        $this->type = Acts::TYPE_CALLBACK;
        $this->status = Acts::STATUS_SEND;
    }

    public function InsertActProducts($dataObj){
        $model = $dataObj['PRODUCTLIST']['PRODUCTS'];
        ActProducts::deleteAll(['act_id' => $this->Id]);
        $k=0;
        foreach ($model as $items) {
            $k++;
            $data = new ActProducts();
            $data->act_id = $this->Id;
            $data->OrdNo = isset($items['ORDNO'])?(string)$items['ORDNO']:(string)$k;
            $data->Name =$items['NAME'];
            $data->MeasureId = $items['MEASUREID'];
            $data->Count = isset($items['COUNT'])?$items['COUNT']:0;
            $data->Summa = $items['SUMMA'];
            $data->TotalSum = $items['TOTALSUM'];
            if(!$data->save()){
                echo Json::encode($data->getErrors());
            }

        }
        $this->ActProductId = $dataObj['PRODUCTLIST']['ACTPRODUCTID'];
        $this->Tin =  $dataObj['PRODUCTLIST']['TIN'];;
    }

    public function beforeSave($insert)
    {
        if(!$this->isNewRecord && $this->status==Acts::STATUS_DUBL) {
            $this->status = Acts::STATUS_NEW;
        }
        // If new record qila olmaymiz sababi update bo`lgandaxam o`zgartrishimiz kerak. shuning uchun statusni tekshirayapmiz
        if($this->status==Acts::STATUS_NEW) {
            $model = Json::decode($this->json_items);
            ActProducts::deleteAll(['act_id' => $this->Id]);
            $k=0;
            foreach ($model as $items) {
                if (isset($items['ProductName']) &&
                    isset($items['ProductSumma']) &&
                    isset($items['ProductMeasureId']) &&
                    isset($items['ProductCount']) &&
                    isset($items['ProductDeliverySum'])

                ) {
                    $k++;
                    $data = new ActProducts();
                    $data->act_id = $this->Id;
                    $data->OrdNo = (string)$k;
                    $data->Name =$items['ProductName'];
                    $data->MeasureId = $items['ProductMeasureId'];
                    $data->Count = $items['ProductCount'];
                    $data->Summa = $items['ProductSumma'];
                    $data->TotalSum = $items['ProductDeliverySum'];
                    if(!$data->save()){
                        Yii::$app->session->setFlash('danger', 'MAXSULOTLARNI KRITISHDA XATOLIK: '.Json::encode($data->getErrors()));
                        return false;
                    }
                } else {
                    Yii::$app->session->setFlash('danger', 'Maxsulotlar ustunlari to`liq kiritilmagan');
                    return false;
                }
            }

        }



        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
