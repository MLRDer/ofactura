<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use common\models\Company;
use common\models\CompanyUsers;
use common\models\DocInData;
use common\models\DocInDataLog;
use common\models\DocMeasure;
use common\models\DocProducts;
use common\models\DocStatus;
use common\models\Empowerment;
use common\models\EmpowermentInData;
use common\models\EmpowermentProduct;
use common\models\FacturaPks7;
use common\models\Facturas;
use function GuzzleHttp\Psr7\str;
use Yii;
use common\models\Docs;
use common\models\DocsSearch;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocController implements the CRUD actions for Docs model.
 */
class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    const HOST = "https://facturatest.yt.uz";
    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";

    const URL_PKCS = "http://127.0.0.1:9090/dsvs/pkcs7/v1?wsdl";

    /**
     * Lists all Docs models.
     * @return mixed
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }



    public function actionGetDocs(){
        $dateFrom = Yii::$app->request->get('dateFrom',date("Y-m-d"));
        $dateFrom = substr($dateFrom,0,10);
        $dateTo = Yii::$app->request->get('dateTo',date("Y-m-d"));
        $dateTo = substr($dateTo,0,10);
        $limit = Yii::$app->request->get('limit',20);
        $page =Yii::$app->request->get('page');
        $query = Docs::find();
//        echo $dateFrom."=".$dateTo;die;
        $query->where("FacturaId is not null and status<>1");
        $query->andWhere(['type_doc'=>Docs::TYPE_OUT]);
        $query->andWhere(['between', 'date(created_date)', date('Y-m-d',strtotime($dateFrom)), date('Y-m-d',strtotime($dateTo))]);
        $countQuery = clone $query;
        $count = $countQuery->count();
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize($limit);
        $pages->page = $page;
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $data= [];
        foreach ($models as $items){
            $data[]=[
                'facturaId'=>$items['FacturaId'],
                'sellerTin'=>(string)$items['SellerTin'],
                'sentDate'=> date('d.m.Y H:i:s',strtotime($items['created_date'])),
            ];
        }

        return [
            'totalCount'=>$count,
            'page'=>Yii::$app->request->get('page'),
            'items'=>$data
        ];
    }

    public function actionGetJson()
    {
        $id =Yii::$app->request->post('id');
        $model = Docs::findOne(['id'=>$id]);
        $products = DocProducts::find()->andWhere(['company_id'=>Components::GetId(),'doc_id'=>$model->id])->orderBy('SortOreder ASC')->all();
        $productsItesm = [];
        $hasVat = false;
        foreach ($products as $items){
            if($items->ProductVatRate>0)
                $hasVat = true;
            $productsItesm[]=
                [
                    "OrdNo" => $items->SortOreder,
                    "Name" => $items->ProductName,
                    "MeasureId" => (int)$items->ProductMeasureId,
                    "Count" => round((float) $items->ProductCount,2),
                    "Summa" =>round((float) $items->ProductSumma,2),
                    "DeliverySum" => round((float)$items->ProductDeliverySum,2),
                    "VatRate" => round((float)$items->ProductVatRate,2),
                    "VatSum" => round((float)$items->ProductVatSum,2),
                    "DeliverySumWithVat" =>round((float)$items->ProductDeliverySumWithVat,2),
//                    "FuelRate" => round((float)$items->ProductFuelRate,2),
//                    "FuelSum" =>round( (float)$items->ProductFuelSum,2),
//                    "DeliverySumWithFuel" => round((float)$items->ProductDeliverySumWithFuel,2),
                    "WithoutVat" => false
                ];
        }
        $jsonnedData = [
            "FacturaId" => $model->FacturaId,
            "FacturaDoc" => [
                "FacturaNo" => $model->FacturaNo,
                "FacturaDate" => date('Y-m-d',strtotime($model->FacturaDate))
            ],
            "ContractDoc" => [
                "ContractNo" => $model->ContractNo,
                "ContractDate" =>   date('Y-m-d',strtotime($model->ContractDate))
            ],
            "FacturaEmpowermentDoc" => [
                "AgentFacturaId" => $model->AgentFacturaId,
                "EmpowermentNo" => $model->EmpowermentNo,
                "EmpowermentDateOfIssue" =>  $model->EmpowermentDateOfIssue!==null?date('Y-m-d',strtotime($model->EmpowermentDateOfIssue)):null,
                "AgentFio" => $model->AgentFio,
                "AgentTin" => $model->AgentTin
            ],
            "ItemReleasedDoc" => [
                "ItemReleasedFio" => $model->ItemReleasedFio
            ],
            "SellerTin" => $model->SellerTin,
            "BuyerTin" => $model->BuyerTin,
            "Seller" => [
                "Name" => $model->SellerName,
                "Account" => $model->SellerAccount,
                "BankId" => $model->SellerBankId,
                "Address" => $model->SellerAddress,
                "Mobile" => $model->SellerMobile,
                "WorkPhone" => $model->SellerWorkPhone,
                "Oked" => $model->SellerOked,
                "DistrictId" => $model->SellerDistrictId,
                "Director" => $model->SellerDirector,
                "Accountant" => $model->SellerAccountant,
                "VatRegCode" => $model->SellerVatRegCode
            ],
            "Buyer" => [
                "Name" => $model->BuyerName,
                "Account" => $model->BuyerAccount,
                "BankId" => $model->BuyerBankId,
                "Address" => $model->BuyerAddress,
                "Mobile" => $model->BuyerMobile,
                "WorkPhone" => $model->BuyerWorkPhone,
                "Oked" => $model->BuyerOked,
                "DistrictId" =>$model->BuyerDistrictId,
                "Director" => $model->BuyerDirector,
                "Accountant" => $model->BuyerAccountant,
                "VatRegCode" => $model->BuyerVatRegCode
            ],
            "ProductList" => [
                "FacturaProductId" => $model->FacturaProductId,
                "Tin" => $model->SellerTin,
//                "HasFuel" => $model->HasFuel==1?true:false,
                "HasVat" => $hasVat,
                "Products" =>  $productsItesm
            ]
        ];
        return $jsonnedData;
    }

    public function actionGetJsonEmp()
    {
        $id =Yii::$app->request->post('id');
        $model = Empowerment::findOne(['id'=>$id]);
        $products = EmpowermentProduct::find()->andWhere(['company_id'=>Components::GetId(),'empowerment_id'=>$model->id])->all();

        $k=0;
        foreach ($products as $items){
            $k++;
            $productsItesm[]=
                [
                    "OrdNo" => $k,
                    "Name" => $items->Name,
                    "MeasureId" => (string)$items->MeasureId,
                    "Count" => (string) $items->Count,
                ];

        }
        $jsonnedData = [
            "EmpowermentId" => $model->EmpowermentId,
            "EmpowermentDoc" => [
                "EmpowermentNo" => $model->EmpowermentNo,
                "EmpowermentDateOfIssue" => date('Y-m-d',strtotime($model->EmpowermentDateOfIssue)),
                "EmpowermentDateOfExpire" => date('Y-m-d',strtotime($model->EmpowermentDateOfExpire))
            ],
            "ContractDoc" => [
                "ContractNo" => $model->ContractNo,
                "ContractDate" =>   date('Y-m-d',strtotime($model->ContractDate))
            ],
            "Agent" => [
                "AgentEmpowermentId" => $model->AgentEmpowermentId,
                "AgentTin" => (string)$model->AgentTin,
                "JobTitle" => $model->AgentJobTitle,
                "Fio" => $model->AgentFio,
                "Passport"=>['Number'=>$model->AgentPassportNumber,'DateOfIssue'=>date('Y-m-d',strtotime($model->AgentPassportDateOfIssue)),'IssuedBy'=>$model->AgentPassportIssuedBy],
            ],
            "SellerTin" => (string)$model->SellerTin,
            "BuyerTin" => (string)$model->BuyerTin,
            "Seller" => [
                "Name" => $model->SellerName,
                "Account" => $model->SellerAccount,
                "BankId" => (string)$model->SellerBankId,
                "Address" => $model->SellerAddress,
                "Mobile" => $model->SellerMobile,
                "WorkPhone" => $model->SellerWorkPhone,
                "Oked" => (string)$model->SellerOked,
//                "DistrictId" => $model->SellerDistrictId,
//                "DistrictId" => "",
                "Director" => $model->SellerDirector,
                "Accountant" => $model->SellerAccountant,
            ],
            "Buyer" => [
                "Name" => $model->BuyerName,
                "Account" => $model->BuyerAccount,
                "BankId" => (string)$model->BuyerBankId,
                "Address" => $model->BuyerAddress,
                "Mobile" => $model->BuyerMobile,
                "WorkPhone" => $model->BuyerWorkPhone,
                "Oked" => (string)$model->BuyerOked,
//                "DistrictId" =>$model->BuyerDistrictId,
//                "DistrictId" =>"",
                "Director" => $model->BuyerDirector,
                "Accountant" => $model->BuyerAccountant,
            ],
            "ProductList" => [
                "EmpowermentProductId" => $model->EmpowermentProductId,
                "Tin" => $model->BuyerTin,
                "Products" =>  $productsItesm
            ]
        ];
        return $jsonnedData;
    }


    public function actionTest(){
//        $model = Components::getNp1("300598370");
        $model = Components::getNdsCode("300598370",'regCode');
        return $model;
    }

    public function actionAferta(){
        $text = Yii::$app->request->post('data');
        $model = Company::findOne(['id'=>Components::GetId()]);
//        echo Components::GetId();die;
//        if(empty($model)){
//            $session = Yii::$app->session;
//            $session->set('company_id',null);
//        }
        $model->is_aferta = 1;
        $model->aferta_text = $text;
        $model->save();
        $result = [
           'Success'=>true,
        ];
        return $result;
    }

    public function actionGetAgentTin(){
        $tin = Yii::$app->request->post('tin');
        $model = Components::getFizNp1($tin);
        $model = Json::decode($model);
        $model['passIssueDate'] = date('Y-m-d',strtotime($model['passIssueDate']));
        return $model;
    }

//   .::CALL-BACK FOR EMPOVERMWNT BEGIN ::.

    public function actionSendUserEmp(){
        $reason="";
        $data = file_get_contents('php://input');
        $data_Json = $data;
        try {
            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $emp = $result['pkcs7Info'];
            $emp = $emp['documentBase64'];
            $emp = base64_decode($emp);
            $emp = Json::decode($emp);
            $saved = Empowerment::SetData($emp, $emp['Agent']['AgentTin'], Docs::TYPE_IN_AGENT);
            $reason = $saved;
        } catch (\Exception $exception){
            $model = new EmpowermentInData();
            $model->created_date = date('Y-m-d H:i:s');
            $model->reason = $reason."|".$exception->getMessage();
            $model->type = 1;
            $model->emp_data = $data_Json;
            $model->enabled = 0;
            if (!$model->save()) {
                Yii::$app->response->statusCode = 500;
                return Json::encode($model->getErrors());
            }
        }
        return $reason;
    }

    public function actionAcceptAgentEmp(){
        $reason="";
        try {
            $data = file_get_contents('php://input');
            $recData = $data;
            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $emp = $result['pkcs7Info'];
            $emp = $emp['documentBase64'];
            $emp = base64_decode($emp);
            $emp = Json::decode($emp);
            $saved = Empowerment::SetData($emp, $emp['SellerTin'], Docs::TYPE_IN);
            $reason = $saved;
        } catch (\Exception $exception){
            $model = new EmpowermentInData();
            $model->emp_data = $recData;
            $model->created_date = date('Y-m-d H:i:s');
            $model->type = 2;
            $model->reason = $reason."|".$exception->getMessage();
            $model->enabled = 0;
            if (!$model->save()) {
                Yii::$app->response->statusCode = 500;
                return Json::encode($model->getErrors());
            }
        }
        return $reason;
    }

    public function actionRejectAgentEmp(){
        $reason="";
        try {
            $data = file_get_contents('php://input');
            $recData = $data;
            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $emp = $result['pkcs7Info'];
            $emp = $emp['documentBase64'];
            $emp = base64_decode($emp);
            $emp = Json::decode($emp);
            $emp = $emp['Empowerment'];
            $empModel = Empowerment::findOne(['EmpowermentId' => $emp['EmpowermentId'], 'type' => Docs::TYPE_OUT]);
            if (!empty($empModel)) {
                $empModel->status = Docs::REJECTED;
                if (!$empModel->save()) {
                    $reason = Json::encode($empModel->getErrors());
                }
            }

        } catch (\Exception $exception) {
            $model = new EmpowermentInData();
            $model->emp_data = $recData;
            $model->created_date = date('Y-m-d H:i:s');
            $model->type = 3;
            $model->reason = $reason."|".$exception->getMessage();
            $model->enabled = 0;
            if (!$model->save()) {
                Yii::$app->response->statusCode = 500;
                return Json::encode($model->getErrors());
            }
        }
        return 'success';
    }

    public function actionAcceptEmp(){
        $reason="";
        try {
            $data = file_get_contents('php://input');
            $recData = $data;
            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $emp = $result['pkcs7Info'];
            $emp = $emp['documentBase64'];
            $emp = base64_decode($emp);
            $emp = Json::decode($emp);
            $empModel = Empowerment::findOne(['EmpowermentId' => $emp['EmpowermentId'], 'type' => Docs::TYPE_OUT]);
            if (!empty($empModel)) {
                $empModel->status = Docs::ACCEPTED;
                if (!$empModel->save()) {
                    $reason = Json::encode($empModel->getErrors());
                }
            }
            $empModel = Empowerment::findOne(['EmpowermentId' => $emp['EmpowermentId'], 'type' => Docs::TYPE_IN_AGENT]);
            if (!empty($empModel)) {
                $empModel->status = Docs::ACCEPTED;
                $empModel->save();
                if (!$empModel->save()) {
                    $reason = Json::encode($empModel->getErrors());
                }
            }
        } catch (\Exception $exception) {
            $model = new EmpowermentInData();
            $model->emp_data = $recData;
            $model->created_date = date('Y-m-d H:i:s');
            $model->type = 4;
            $model->reason = $reason."|".$exception->getMessage();
            $model->enabled = 0;
            if (!$model->save()) {
                Yii::$app->response->statusCode = 500;
                return Json::encode($model->getErrors());
            }
        }
        return "success";
    }

    public function actionRejectEmp(){
        $reason="";
        $data = file_get_contents('php://input');
        try{
        $data = Json::decode($data);
        $jsonData = $data;
        $client = new \SoapClient(self::URL_PKCS);
        $result = $client->verifyPkcs7([ "pkcs7B64" =>$data['Sign']]);
        $result = $result->return;
        $result = Json::decode($result);
        $emp =  $result['pkcs7Info'];
        $emp = $emp['documentBase64'];
        $emp = base64_decode($emp);
        $emp = Json::decode($emp);
        $emp = $emp['Empowerment'];
        $empModel = Empowerment::findOne(['EmpowermentId'=>$emp['EmpowermentId'],'type'=>Docs::TYPE_OUT]);
        if(!empty($empModel)){
            $empModel->status = Docs::REJECTED;
            if(!$empModel->save()){
                $reason = Json::encode($empModel->getErrors());
            }
        }
        $empModel = Empowerment::findOne(['EmpowermentId'=>$emp['EmpowermentId'],'type'=>Docs::TYPE_IN_AGENT]);
        if(!empty($empModel)){
            $empModel->status = Docs::REJECTED;
            $empModel->save();
            if(!$empModel->save()){
                $reason = Json::encode($empModel->getErrors());
            }
        }
        } catch (\Exception $exception) {
            $model = new EmpowermentInData();
            $model->emp_data = $jsonData;
            $model->created_date = date('Y-m-d H:i:s');
            $model->type = 5;
            $model->reason = $reason."|".$exception->getMessage();
            $model->enabled = 0;
            if(!$model->save()){
                Yii::$app->response->statusCode = 500;
                return Json::encode($model->getErrors());
            }
        }

        return 'success';
    }

    public function actionCancelUserEmp(){
        $reason="";
        $data = file_get_contents('php://input');
        try {
            $data = Json::decode($data);
            $jsonData= $data;
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $emp = $result['pkcs7Info'];
            $emp = $emp['documentBase64'];
            $emp = base64_decode($emp);
            $emp = Json::decode($emp);

            $empModel = Empowerment::findOne(['EmpowermentId' => $emp['EmpowermentId'], 'type' => Docs::TYPE_IN_AGENT]);
            if (!empty($empModel)) {
                $empModel->status = Docs::CANCELED;
                $empModel->save();
                if (!$empModel->save()) {
                    $reason = Json::encode($empModel->getErrors());
                }
            }
        } catch (\Exception $exception) {
            $model = new EmpowermentInData();
            $model->emp_data = $jsonData;
            $model->created_date = date('Y-m-d H:i:s');
            $model->type = 6;
            $model->reason = $reason."|".$exception->getMessage();
            $model->enabled = 0;
            if (!$model->save()) {
                Yii::$app->response->statusCode = 500;
                return Json::encode($model->getErrors());
            }
        }
    }

    public function actionSendAgentEmp(){
        $reason="";
        $data = file_get_contents('php://input');
        try {

            $jsonData = $data;

            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $emp = $result['pkcs7Info'];
            $emp = $emp['documentBase64'];
            $emp = base64_decode($emp);
            $emp = Json::decode($emp);

            $empModel = Empowerment::findOne(['EmpowermentId' => $emp['EmpowermentId'], 'type' => Docs::TYPE_OUT]);
            if (!empty($empModel)) {
                $empModel->status = Docs::AGENT_ACCEPTED;
                if (!$empModel->save()) {

                }
            }

        } catch (\Exception $exception) {
            $model = new EmpowermentInData();
            $model->emp_data = $jsonData;
            $model->created_date = date('Y-m-d H:i:s');
            $model->type = 7;
            $model->reason = $reason."|".$exception->getMessage();
            $model->enabled = 0;
            if (!$model->save()) {
                Yii::$app->response->statusCode = 500;
                return Json::encode($model->getErrors());
            }
        }
        return "success";
    }
//   ...CALL-BACK FOR EMPOVERMWNT END ...

//   .::CALL-BACK FOR FACTURA BEGIN ::.

    public function actionSend(){
        $reason="";
        $data = file_get_contents('php://input');
        $data_request = $data;
        $result=[];
        try {
            $factura = $this->ProcessingReceivedData($data);
            $facturaUpper = $this->ValidateFacturaData($factura);
            $this->InsertInFactura($facturaUpper);
            $data = Json::decode($data);
            $this->InsertPks($facturaUpper['FACTURAID'],$data['Sign']);
             if ($reason == "") {
                $result = [
                    'success' => true,
                ];
            } else {
                $result = [
                    'success' => false,
                    'reason' => $reason
                ];
            }
        } catch (\Exception $exception){
            $model = new DocInData();
            $model->doc_data = $data_request;
            $model->created_date = date('Y-m-d H:i:s');
            $model->reason = $reason."|".$exception->getMessage();
            $model->type = DocInData::IN_DOC;
            $model->enabled = 0;
            $model->save();
            echo 'Caught exception: ',  $exception->getMessage(), "\n";

        }
        return $result;
    }

    public function actionAccept(){
        $reason="";
        $data = Yii::$app->request->rawBody;
        $result="";

        try {

            $data_request = $data;
            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $factura = $result['pkcs7Info'];
            $factura = $factura['documentBase64'];
            $factura = base64_decode($factura);
            $factura = Json::decode($factura);
            if (!isset($factura['FacturaId'])) {
                $factura['FacturaId'] = $factura['facturaid'];
            }


//            $modelFactura = Docs::findOne(['FacturaId' => $factura['FacturaId'], 'type_doc' => DocInData::SEND_DOC]);
//            if (empty($modelFactura)) {
//                $reason = "EROR: Factura id boyicha malumot topilmadi. FacturaId:" . $factura['FacturaId'];
//            } else {
//                $modelFactura->status = Docs::ACCEPTED;
//                $modelFactura->save(false);
//            }

            $newFactura = Facturas::findOne(['Id'=>$factura['FacturaId']]);
            if(!empty($newFactura)){
                $newFactura->status = Facturas::STATUS_ACCEPTED;
                if(!$newFactura->save()){
                    echo $newFactura->getErrors();
                };
            }


            if ($reason == "") {
                $result = [
                    'success' => true,
                ];
            } else {
                $result = [
                    'success' => false,
                    'reason' => $reason
                ];
            }
        } catch (\Exception $exception){
            $error_lof = new DocInData();
            $error_lof->doc_data = $data_request;
            $error_lof->reason = $exception->getMessage();
            $error_lof->created_date = date("Y-m-d H:i:s");
            $error_lof->type = 2;
            $error_lof->enabled = 1;
            $error_lof->save();
            echo 'Accepted method: ',  $exception->getMessage(), "\n";

        }
        return $result;
    }

    public function actionReject(){
        $reason="";
        $data = Yii::$app->request->rawBody;
        $data_request = $data;
        $result ="";
        try {
            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);

            $factura = $result['pkcs7Info'];
            $factura = $factura['documentBase64'];
            $factura = base64_decode($factura);
            $factura = Json::decode($factura);
            $noties = $factura['Notes'];
            $factura = $factura['Factura'];
            if (!isset($factura['FacturaId'])) {
                $factura['FacturaId'] = $factura['facturaid'];
            }
//            $modelFactura = Docs::findOne(['FacturaId' => $factura['FacturaId'], 'type_doc' => DocInData::SEND_DOC]);
//            if (empty($modelFactura)) {
//                $reason = "EROR: Factura id boyicha malumot topilmadi. FacturaId:" . $factura['FacturaId'];
//            } else {
//                $modelFactura->status = Docs::REJECTED;
//                $modelFactura->notes = $noties;
//                $modelFactura->save(false);
//            }
            $newFactura = Facturas::findOne(['Id'=>$factura['FacturaId']]);
            if(!empty($newFactura)){
                $newFactura->status = Facturas::STATUS_REJECTED;
                $newFactura->notes = $noties;
                if(!$newFactura->save()){
                    echo $newFactura->getErrors();
                };
            }
            if ($reason == "") {

                $result = [
                    'success' => true,
                ];
            } else {

                $result = [
                    'success' => false,
                    'reason' => $reason
                ];
            }
        } catch (\Exception $exception){
            $error_lof = new DocInData();
            $error_lof->doc_data = $data_request;
            $error_lof->reason = $exception->getMessage();
            $error_lof->created_date = date("Y-m-d H:i:s");
            $error_lof->type = 3;
            $error_lof->enabled = 1;
            $error_lof->save();
            echo 'Accepted method: ',  $exception->getMessage(), "\n";
        }

        return $result;
    }

    public function actionCancel(){
        $reason="";
        $data = Yii::$app->request->rawBody;
        $data_request = $data;
        $result="";
        try {
            $data = Json::decode($data);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7(["pkcs7B64" => $data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);

            $factura = $result['pkcs7Info'];
            $factura = $factura['documentBase64'];
            $factura = base64_decode($factura);
            $factura = Json::decode($factura);
            if (!isset($factura['FacturaId'])) {
                $factura['FacturaId'] = $factura['facturaid'];
            }
//            $modelFactura = Docs::findOne(['FacturaId' => $factura['FacturaId'], 'type_doc' => DocInData::SEND_DOC]);
//            if (empty($modelFactura)) {
//                $reason = "EROR: Factura id boyicha malumot topilmadi. FacturaId:" . $factura['FacturaId'];
//            } else {
//                $modelFactura->status = Docs::CANCELED;
//                $modelFactura->save(false);
//            }
            $newFactura = Facturas::findOne(['Id'=>$factura['FacturaId']]);
            if(!empty($newFactura)){
                $newFactura->status = Facturas::STATUS_CANCELLED;
                if(!$newFactura->save()){
                    echo $newFactura->getErrors();
                };
            }
            if ($reason == "") {
                $result = [
                    'success' => true,
                ];
            } else {
                $result = [
                    'success' => false,
                    'reason' => $reason
                ];
            }
        } catch (\Exception $exception){
            $error_lof = new DocInData();
            $error_lof->doc_data = $data_request;
            $error_lof->reason = $exception->getMessage();
            $error_lof->created_date = date("Y-m-d H:i:s");
            $error_lof->type = 4;
            $error_lof->enabled = 1;
            $error_lof->save();
            echo 'Accepted method: ',  $exception->getMessage(), "\n";
        }
        return $result;
    }
//   ...CALL-BACK FOR FACTURA END ...

    public function actionIndex()
    {
//        $searchModel = new DocsSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return true;
    }

    public function actionBindRole()
    {
        $data = Yii::$app->request->post('sign');
        $id = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type');
        $result = $this->SendBindData($data);
        $result = Json::decode($result);
        $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';

        if($reason==""){
            $model = CompanyUsers::findOne(['id'=>$id]);
            $model->enabled = $type;
            if(!$model->save()){
                $reason = Json::encode($model->getErrors());
            }
        }

        if($reason==""){

            $result = [
                'Success'=>true,
            ];
        } else {
            $result = [
                'Success'=>false,
                'reason'=>$reason
            ];
        }
        return $result;
    }

    public function actionSaerchPhysic(){
        $tin = Yii::$app->request->post('tin');
        $reason = "";


        $num = substr($tin,0,1);
        if($num==2 || $num==3){
            $reason = "STIR jismoniy shaxsga tegishli bo`lishi lozim";
        }

        if($reason==""){
           if($tin==Components::CompanyData('tin')){
               $reason = "Bu STIR o'zinggizga tegishli";
           }
        }

        if($reason==""){
            $check = CompanyUsers::findOne(['company_id'=>Components::GetId(),'users_id'=>$tin]);
            if(!empty($check)){
                $reason = "Bu STIR sizga biriktirilgan ID:".$check->id;
            }
        }
        if($reason==""){
            $data = Json::decode(Components::getFizNp1($tin));
            if($data['fullName']==null){
                $reason="Bu STIR ga tegishli malumot topilmadi";
            }
        }
        if($reason==""){
            $result = [
               'success'=>true,
               'html'=>$this->renderPartial('_stitPhyisic',['model'=>$data])
            ];
        } else {
            $result=[
              'success'=>false,
              'reason'=>$reason
            ];
        }

        return $result;
    }

    public function actionGettimestamp(){
        $signatureHex = Yii::$app->request->post('signatureHex');
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            )
        );
        $reason ="";
        $context = stream_context_create($opts);
        $url = Yii::$app->params['factura_host']."/provider/api/uz/utils/timestamp?signatureHex=".$signatureHex;
        $data = file_get_contents($url, false, $context);
        $data = Json::decode($data);
        if($data['success']==false){
            $reason = $data['reason'];
        }
        if($reason==""){
            $result = [
                'Success'=>true,
                'Data'=>$data['data'],
            ];
        } else{
            $result = [
                'Success'=>false,
                'Reason'=>$reason
            ];
        }

        return  $result;
    }

    public function actionGetCompany(){

        $tin = Yii::$app->request->post('tin');
        $reason = "";
        if(strlen($tin)!=9){
           $reason = "STIR formati noto'g'ri kiritilgan";
        }


        if($reason==""){
             $number  = substr($tin,0,1);
             if($number==2 || $number==3){
                 $data = Components::getNp1($tin);
                 $data = Json::decode($data);
                 $nds = Components::getNdsCode($tin,'regCode');
                 $data['regCode']= $nds['result'];
                 if($data['name']=="")
                     $reason = Yii::t('main',"Bunday STIR li korxona topilmadi!!!");
             } else {
                 $data = Components::getFizNp1($tin);
                 $data = Json::decode($data);
                 if($data['fullName']!=""){
                     $data = [
                       'name'=>$data['fullName'],
                       'mfo'=>'',
                       'account'=>'',
                       'oked'=>'',
                       'directorTin'=>$tin,
                       'director'=>"",
                       'acountant'=>"",
                       'address'=>$data['address'],
                       'ns10Code'=>$data['ns10Code'],
                       'ns11Code'=>$data['ns11Code'],
                       'regCode'=>""
                     ];
                 }else {
                     $reason = Yii::t('main',"Bu STIRga tegishli malumot topilmadi");
                 }

             }
        }


        if($reason==""){
            $result = [
                'success'=>true,
                'data'=>$data,
                'html'=>$this->renderPartial('company_view',['model'=>$data])
            ];
        } else{
            $result = [
                'success'=>false,
                'reason'=>$reason
            ];
        }

        return  $result;
    }

    public function actionBindProvider(){
        $data = Yii::$app->request->post('sign');
        $sendData = [
            'sign'=>$data,
        ];
//        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/facturas/seller");
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/register/providerbinding");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERPWD, self::LOGIN . ":" . self::PASSWORD);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode($sendData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
        curl_close($ch);
        $return = Json::decode($return);
//        var_dump($return);die;
        $reason = (isset($return['errorMessage'])) ? $return['errorMessage'] : '';
        if($reason==""){
            $model = Company::findOne(['id'=>Components::GetId()]);
            $model->is_online = 1;
            $model->save();
            $res = [
               'Success'=>true,
            ];
        } else {
            $res = [
                'Success'=>false,
                'Reason'=>$reason
            ];
        }
        return $res;

    }

    public function actionGetProviderJson(){
        $companyTin  = Components::CompanyData('tin');
        $dataOnline = Components::CheckOnline($companyTin);
        $dataOnline = Json::decode($dataOnline);

        if(isset($dataOnline['providers'])) {
            foreach ($dataOnline['providers'] as $items) {
                if($items['enabled']==true) {
                    $providers[] = $items['providerTin'];
                }
            }
        }
        $providers[]="306717486";
        $res = [
          "ClientTin"=>$companyTin,
          "ProviderTins"=>$providers
        ];
        return $res;
    }

    public function actionGetMeasure(){
        $model = DocMeasure::find()->all();
        $html = "";
        foreach ($model as $items){
            $html.="<option value='".$items->id."'>".$items->name." </option>";
        }
        return $html;
    }

    protected function SendBindData($data){
        $sendData = [
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
//        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/facturas/seller");
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/utils/binding/company");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERPWD, self::LOGIN . ":" . self::PASSWORD);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode($sendData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    protected function SetNotification($data){
        return 0;
    }


    protected function ProcessingReceivedData($data){

        $data = Json::decode($data);
        $client = new \SoapClient(self::URL_PKCS);
        $result = $client->verifyPkcs7([ "pkcs7B64" =>$data['Sign']]);
        $result = $result->return;
        $result = Json::decode($result);
        $factura =  $result['pkcs7Info'];
        $factura = $factura['documentBase64'];
        $factura = base64_decode($factura);
        $factura = Json::decode($factura);


        return $factura;
    }

    protected function ValidateFacturaData($factura){
        $UpperFactura =[];
        foreach ($factura as $key=>$value){
            if(is_array($value)){
                foreach ($value as $key2=>$value2){
                    if(is_array($value2)){
                        foreach ($value2 as $key3=>$value3){
//                            echo $key3."=>".$value3."\n";
                            if(is_array($value3)){
                                $resPrd =[];
//                                echo count((array)$value3);
//                                if(count((array)$value3)>1) {
//                                    foreach ($value3 as $items) {
//                                        $arraYW = [];
//                                        foreach ($items as $key4 => $value4) {
//                                            $arraYW[mb_strtoupper($key4)] = $value4;
//                                        }
//                                        $resPrd[] = $arraYW;
//                                    }
//                                    $UpperFactura[mb_strtoupper($key)][mb_strtoupper($key2)][mb_strtoupper($key3)] = $resPrd;
//                                } else {
                                    $arra4=[];
                                    foreach ($value3 as $key4=>$value4){
                                        $arra4[mb_strtoupper($key4)]=$value4;
                                    }
                                    $UpperFactura[mb_strtoupper($key)][mb_strtoupper($key2)][mb_strtoupper($key3)] = $arra4;
//                                }
                            } else {
                                $UpperFactura[mb_strtoupper($key)][mb_strtoupper($key2)][mb_strtoupper($key3)] = $value3;
                            }
                        }
                    } else {
//                        echo $key2."=>".$value2."\n";
                        $UpperFactura[mb_strtoupper($key)][mb_strtoupper($key2)] = $value2;
                    }

                }
            } else {
                $UpperFactura[mb_strtoupper($key)] = $value;
//                echo $key."=>".$value."\n";
            }
        }

//        echo Json::encode($UpperFactura);
        return $UpperFactura;
    }

    protected function InsertPks($facturaId, $data){
        $model = FacturaPks7::findOne(['factura_id'=>$facturaId]);
        if(empty($model))
            $model = new FacturaPks7();
//        echo $facturaId;die;
        $model->factura_id = $facturaId;
        $model->seller_pks7 = $data;
        if(!$model->save()){
            var_dump($model->getErrors());die;
        }
    }

    protected function InsertInFactura($factura){
        $model = Facturas::findOne(['Id'=>$factura['FACTURAID']]);
//        echo Json::encode($factura);
        if(empty($model)){
            $model = new Facturas();
            $model->InsertByArray($factura);
            $model->InsertFacturaProducts($factura);
            if(!$model->save()){
                echo Json::encode($model->getErrors());
            }
        }
    }


}
