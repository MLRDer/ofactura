<?php

namespace cabinet\controllers;


use cabinet\classes\consts\ExcelConst;
use cabinet\classes\consts\ReestrConst;
use cabinet\classes\viewers\ExcelViewer;
use cabinet\models\Components;
use cabinet\models\Excel;
use cabinet\tests\FunctionalTester;
use common\models\Company;
use common\models\CompanyInvoicesHelpers;
use common\models\CompanyTarif;
use common\models\CompanyTarifLog;
use common\models\CompanyUsers;
use common\models\DocInData;
use common\models\DocProducts;
use common\models\Invoices;
use common\models\MonthPay;
use common\models\ReestrMain;
use kartik\mpdf\Pdf;
use Yii;
use common\models\Docs;
use common\models\DocsSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DocController implements the CRUD actions for Docs model.
 */
class DocController extends \cabinet\components\Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * Lists all Docs models.
     * @return mixed
     */

//    const HOST = "https://facturatest.yt.uz";
    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";





    public function actionIndex()
    {
        $searchModel = new DocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId()]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChange($id){
        $model = CompanyUsers::findOne(['users_id'=>Yii::$app->user->id,'id'=>$id]);

        $reason="";
        if(empty($model)){
            $reason = "Bu korxona sizga biriktirilmagan";
        }
        if($reason==""){
            if($model->enabled!==1){
                $reason = "Imkoniyatlar faollashtirilmagan";
            }
        }

        if($reason==""){
            $session = Yii::$app->session;
            $session->set('company_id',$model->company_id);
            Yii::$app->session->setFlash('success',  'Muafiyaqatli ozgartirildi');
        } else {
            Yii::$app->session->setFlash('error',  $reason);
        }

        return Yii::$app->controller->goBack();

    }
    public function actionImportExcel(){
        $request = Yii::$app->request;
        $model = new Docs();
        $respons = "";
        $productsItesm = [];
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post())){
                $r = $model->upload();
                if($r!==true){
                    var_dump($r);
                }
                $data = ExcelViewer::readFull(ExcelConst::FILE_PATH . ExcelConst::FILE_NAME);
                $i=0;
                $ord=0;
                $is_fuel = 0;
                foreach ($data as $items) {

                    $i++;
                    $ord++;
                    if ($i <= ExcelConst::ROW_BEGIN_KEY) {
                        $ord = 0;
                        continue;
                    }

                    $productsItesm[$ord] =
                        [
                            "ProductName" => $items[ExcelConst::KEY_NAME],
                            "ProductMeasureId" => $items[ExcelConst::KEY_CODE],
                            "ProductCount" => (int)$items[ExcelConst::KEY_COUNT],
                            "ProductSumma" => round((float)$items[ExcelConst::KEY_PRICE],2),
                            "ProductDeliverySum" => round((float)$items[ExcelConst::KEY_DELIVER_SUM],2),
                            "ProductVatRate" => round((float)$items[ExcelConst::KEY_VAT_RATE],2),
                            "ProductVatSum" => round((float)$items[ExcelConst::KEY_VAT_VALUE],2),
                            "ProductDeliverySumWithVat" => round((float)$items[ExcelConst::KEY_DELIVER_WITH_RATE],2),
                            "ProductFuelSum" => round((float)$items[ExcelConst::KEY_FUEL_VALUE],2),
                            "ProductFuelRate" => round((float)$items[ExcelConst::KEY_FUEL_RATE],2),
                            "ProductDeliverySumWithFuel" => round((float)$items[ExcelConst::KEY_DELIVER_WITH_FUEL],2),
                        ];
                    $is_fuel = $is_fuel + round((float)$items[ExcelConst::KEY_FUEL_VALUE],2);
                }
                if($items[ExcelConst::KEY_FUEL_VALUE]!==null){
                    $html = $this->renderPartial('_productItemsWithFuel', ['data' => $data]);
                } else {
                    $html= $this->renderPartial('_productItems', ['data' => $data]);
                }
            }
        }

        if($respons==""){
            $result = [
               'success'=>true,
               'html'=>$html,
               'fuel'=>($is_fuel>0)?1:0,
               'data'=>Json::encode($productsItesm)
            ];
        } else {
            $result = [
                'success'=>false,
                'html'=>$respons
            ];
        }
        return $result;
    }






    public function actionOutList()
    {
        $searchModel = new DocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('status<>1')->andWhere(['company_id'=>Components::GetId(),'type_doc'=>Docs::TYPE_OUT]);
        return $this->render('indexSend', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNewList()
    {
        $searchModel = new DocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId(),'status'=>Docs::NEW_DATA ,'type_doc'=>Docs::TYPE_OUT]);
        return $this->render('indexNew', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInList()
    {
        $searchModel = new DocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId(),'type_doc'=>1]);
        return $this->render('indexIn', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Docs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $products = DocProducts::find()->andWhere(['doc_id'=>$model->id])->orderBy('SortOreder ASC')->all();
        $productsItesm = [];

        foreach ($products as $items){
            $productsItesm[]=
                [
                    "OrdNo" => $items->SortOreder,
                    "Name" => $items->ProductName,
                    "MeasureId" => (int)$items->ProductMeasureId,
                    "Count" => (int)$items->ProductCount,
                    "Summa" =>(int) $items->ProductSumma,
                    "DeliverySum" => (int)$items->ProductDeliverySum,
                    "VatRate" => (int)$items->ProductVatRate,
                    "VatSum" => (int)$items->ProductVatSum,
                    "DeliverySumWithVat" =>(int) $items->ProductDeliverySumWithVat,
                    "FuelRate" => (int)$items->ProductFuelRate,
                    "FuelSum" => (int)$items->ProductFuelSum,
                    "DeliverySumWithFuel" => (int)$items->ProductDeliverySumWithFuel,
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
                 "EmpowermentDateOfIssue" =>  date('Y-m-d',strtotime($model->EmpowermentDateOfIssue)),
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
                 "DistrictId" => "2601",
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
                 "DistrictId" => "0601",
                 "Director" => $model->BuyerDirector,
                 "Accountant" => $model->BuyerAccountant,
                 "VatRegCode" => $model->BuyerVatRegCode
             ],
             "ProductList" => [
                 "FacturaProductId" => $model->FacturaProductId,
                 "Tin" => $model->SellerTin,
                 "HasFuel" => $model->HasFuel==1?true:false,
                 "HasVat" => true,
                 "Products" =>  $productsItesm
             ]
         ];




        return $this->render('view', [
            'model' => $model,
            'products' =>$products,
            'Json'=>Json::encode($jsonnedData)
        ]);
    }




    public function actionSetTarif($id)
    {
        $model = CompanyTarif::findOne(['id'=>$id]);
        $sum = $model->price * $model->value_doc;
        if ($sum==0){
            $sum = $model->month_mony;
        }
        $invoices_sum = Components::CompanyData('invoices_sum');

        if($sum<$invoices_sum){
            $tarifLog = new CompanyTarifLog();
            $tarifLog->company_id = Components::GetId();
            $tarifLog->tarif_id = $model->id;
            $tarifLog->created_date = date('Y-m-d H:i:s');
            $tarifLog->remain_value = $model->value_doc;
            $tarifLog->status = 1;
            $tarifLog->enabled = 1;
            if($tarifLog->save()) {
                $invoices = new Invoices();
                $invoices->company_id = Components::GetId();
                $invoices->type_invoices = 0;
                $invoices->created_date = date('Y-m-d H:i:s');
                $invoices->value = $sum;
                $invoices->reason = "Oylik abanent to`lovi uchun";
                $invoices->tarif_id = $model->id;
                $invoices->status = 1;
                $invoices->enabled = 1;
                if($invoices->save()){
                    $data = Company::findOne(['id'=>Components::GetId()]);
                    $data->tarif_id = $model->id;
                    $data->invoices_sum = $data->invoices_sum - $sum;
                    $data->save();
                }
            }
            Yii::$app->session->setFlash('success', 'Tarif muafiyaqatli o`zgartirildi');
            return $this->redirect('tarif');
        } else{
            $must_mony = $sum;
            if($invoices_sum>0) {
                $must_mony = $sum - $invoices_sum;
            }
            Yii::$app->session->setFlash('error', 'Hisobda mablag` yetarli emas. Tarifni faolashtirish uchun iltimos xisobinggizni <b> '.number_format($must_mony).'  </b> so`mga  to`ldiring <span class="right"><a href="/invoices/payme" class="btn btn-warning btn-xs"> Hisobni to`ldirish </a> </span> ');
            return $this->redirect('tarif');
        }

    }

    public function actionSend()
    {
        $data = Yii::$app->request->post('sign');
        $facturaId = Yii::$app->request->post('facturaId');
        $reason="";
        $sum = Components::getSum();

        if($sum==0){
            $reason = "Xisobingizni to'ldiring";
        }
//        if($reason==""){
//            $monthPay = MonthPay::findOne(['company_id'=>Components::GetId(),'enabled'=>1]);
//            if(empty($monthPay)){
//                $reason = Components::setMonthSum($sum);
//            } else{
//                $end_date = strtotime($monthPay->end_date);
//                $today = strtotime(date('Y-m-d'));
//                if($today>$end_date){
//                    $monthPay->enabled = 0;
//                    if($monthPay->save()){
//                        $reason = Components::setMonthSum($sum);
//                    } else {
//                        $reason = Json::encode($monthPay->getErrors());
//                    }
//                }
//            }
//        }

        if($reason==""){
            $model = Docs::findOne(['id'=>$facturaId,'company_id'=>Components::GetId()]);
            if(empty($model)){
                $reason="Bunday factura topilmadi";
            }
        }

        if($reason==""){
            if($sum<=0){
                $reason="Xisobda yetarli mablag` mavjud emas";
            } else {
                $tarif = CompanyTarif::findOne(['id'=>1]);
                $doc_sum = $tarif->price;
                if($doc_sum<$sum){
                    $model->status = Docs::SEND;
                    $saldoModel = Invoices::findAll(['company_id'=>Components::GetId()]);
                    $saldo_value = 0;
                    $saldo_oplata = 0;
                    $saldo_nachisleniya = 0;
                    foreach ($saldoModel as $items){
                        if($items['type_invoices']==1) {
                            $saldo_oplata = $items['value'];
                        }
                        if($items['type_invoices']==0) {
                            $saldo_nachisleniya = $items['value'];
                        }
                    }
                    $saldo_value = $saldo_oplata - $saldo_nachisleniya;
                    $invoices = new Invoices();
                    $invoices->company_id = Components::GetId();
                    $invoices->type_invoices = Invoices::INVOICES;
                    $invoices->saldo_value = $saldo_value;
                    $invoices->created_date = date('Y-m-d H:i:s');
                    $invoices->value = $doc_sum;
                    $invoices->reason = $tarif->name." ga ko'ra №:".$model->FacturaNo." raqamli xujjat uchun xisob yechib olindi";
                    $invoices->tarif_id = $model->id;
                    $invoices->status = 1;
                }
            }
        }

        if($reason=="") {
            $result = $this->SendFacturaWithCurl($data);
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Docs::SEND;
            if(!$model->save(false)){
                foreach ($model->getErrors() as $key=>$value){
                    $reason.=$value[0];
                }
            }
            if($invoices->save()){
                $company = Company::findOne(['id'=>Components::GetId()]);
                $company->invoices_sum = $company->invoices_sum - $doc_sum;
                $company->save();
                $model->docs_pks7 = $data;
                $model->save();
            } else {
                $reason = Json::encode($invoices->getErrors());
            }
        }


        if($reason==""){
            $res=[
                'Success'=>true,
            ];
        } else {
            $res=[
                'Success'=>false,
                'reason'=>$reason
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $res;
    }

    public function actionAcceptData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $facturaId = Yii::$app->request->post('facturaId');
        $model = Docs::findOne(['id'=>$facturaId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }

//        if($reason==""){
//            $sum = Components::getSum();
//            if($sum==0){
//                $reason = "Oylik to'lovni yechib olish uchun xisobni to'ldiring";
//            }
//            if($reason=="") {
//                $monthPay = MonthPay::findOne(['company_id' => Components::GetId(), 'enabled' => 1]);
//                if (empty($monthPay)) {
//                    $reason = Components::setMonthSum($sum);
//                } else {
//                    $end_date = strtotime($monthPay->end_date);
//                    $today = strtotime(date('Y-m-d'));
//                    if ($today > $end_date) {
//                        $monthPay->enabled = 0;
//                        if ($monthPay->save()) {
//                            $reason = Components::setMonthSum($sum);
//                        } else {
//                            $reason = Json::encode($monthPay->getErrors());
//                        }
//                    }
//                }
//            }
//        }

        if($reason=="") {
            $result = $this->AcceptFacturaWithCurl($data, $model->FacturaId, 'accept');
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Docs::ACCEPTED;
            $model->save();
            $res=[
                'Success'=>true,
                'reason'=>$result
            ];
        } else {
            $res=[
                'Success'=>false,
                'reason'=>$reason
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $res;
    }
    public function actionRejectData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $facturaId = Yii::$app->request->post('facturaId');
        $model = Docs::findOne(['id'=>$facturaId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }
//        if($reason==""){
//            $sum = Components::getSum();
//            if($sum==0){
//                $reason = "Oylik to'lovni yechib olish uchun xisobni to'ldiring";
//            }
//            if($reason=="") {
//                $monthPay = MonthPay::findOne(['company_id' => Components::GetId(), 'enabled' => 1]);
//                if (empty($monthPay)) {
//                    $reason = Components::setMonthSum($sum);
//                } else {
//                    $end_date = strtotime($monthPay->end_date);
//                    $today = strtotime(date('Y-m-d'));
//                    if ($today > $end_date) {
//                        $monthPay->enabled = 0;
//                        if ($monthPay->save()) {
//                            $reason = Components::setMonthSum($sum);
//                        } else {
//                            $reason = Json::encode($monthPay->getErrors());
//                        }
//                    }
//                }
//            }
//        }

        if($reason=="") {
            $result = $this->AcceptFacturaWithCurl($data, $model->FacturaId, 'reject');
//            var_dump($result);die;
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Docs::REJECTED;
            $model->save();
            $res=[
                'Success'=>true,
                'Reason'=>$result
            ];
        } else {
            $res=[
                'Success'=>false,
                'Reason'=>$reason
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $res;
    }

    public function actionCanceledData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $facturaId = Yii::$app->request->post('facturaId');
        $model = Docs::findOne(['id'=>$facturaId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }
//        if($reason==""){
//            $sum = Components::getSum();
//            if($sum==0){
//                $reason = "Oylik to'lovni yechib olish uchun xisobni to'ldiring";
//            }
//            if($reason=="") {
//                $monthPay = MonthPay::findOne(['company_id' => Components::GetId(), 'enabled' => 1]);
//                if (empty($monthPay)) {
//                    $reason = Components::setMonthSum($sum);
//                } else {
//                    $end_date = strtotime($monthPay->end_date);
//                    $today = strtotime(date('Y-m-d'));
//                    if ($today > $end_date) {
//                        $monthPay->enabled = 0;
//                        if ($monthPay->save()) {
//                            $reason = Components::setMonthSum($sum);
//                        } else {
//                            $reason = Json::encode($monthPay->getErrors());
//                        }
//                    }
//                }
//            }
//        }

        if($reason=="") {
            $result = $this->CanceledFacturaWithCurl($data, $model->FacturaId, 'reject');
//            var_dump($result);die;
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Docs::CANCELED;
            $model->save();
            $res=[
                'Success'=>true,
                'Reason'=>$result
            ];
        } else {
            $res=[
                'Success'=>false,
                'Reason'=>$reason
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $res;
    }




    protected function getId(){
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            )
        );
        $context = stream_context_create($opts);
        $url = Yii::$app->params['factura_host']."/provider/api/ru/utils/guid";
        $res = file_get_contents($url, false, $context);
        $id="";
        $res = Json::decode($res);
        if($res['success']){
            $id = $res['data'];
        }

        return $id;
    }




    protected function SendFactura($data){
        $sendData = [
           'sign'=>$data,
           'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $query = http_build_query($sendData);
        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD),
                    'content' =>$query
            )
        );
        $context = stream_context_create($opts);
        $url = Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/facturas/seller";
//        echo $url;die;
        return file_get_contents($url, false, $context);
    }

    protected function SendFacturaWithCurl($data){
        $sendData = [
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/facturas/seller");
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

    protected function AcceptFacturaWithCurl($data,$factura_id,$action){
        $sendData = [
            "action"=>$action,
            'facturaId'=>$factura_id,
            'notes'=>"Bekor qilindi",
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/facturas/buyer");
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

    protected function CanceledFacturaWithCurl($data,$factura_id,$action){
        $sendData = [
            'facturaId'=>$factura_id,
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/facturas/seller/cancel");
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


    public function actionTarif()
    {
        $model = CompanyTarif::find()->all();
        return $this->render('tarif', [
            'model' => $model,
        ]);
    }



    public function actionPdf($id){
        $model = $this->findModel($id);
        $products = DocProducts::find()->andWhere(['company_id'=>Components::GetId(),'doc_id'=>$model->id])->orderBy('SortOreder ASC')->all();

        $content = $this->renderPartial('_pdf',['model'=>$model,'products' =>$products]);
//        echo $content;die;
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }


    /**
     * Creates a new Docs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Docs();
        $accountant_num = "";
        $acountant = CompanyInvoicesHelpers::findOne(['company_id'=>Components::GetId()]);
        if(!empty($acountant)){
            $accountant_num = $acountant->invoices_number;
        }
        $CompanyData = Company::findOne(['id'=>Components::GetId()]);
        $model->FacturaDate = date('Y-m-d');
        $model->ContractDate = date('Y-m-d');
        $model->company_id = $CompanyData->id;
        $model->SellerTin = $CompanyData->tin;
        $model->SellerName = $CompanyData->name;
        $model->SellerAddress = $CompanyData->address;
        $model->SellerOked = $CompanyData->oked;
        $model->SellerDistrictId = $CompanyData->district_id;
        $model->SellerBankId = $CompanyData->mfo;
        $model->status = 1;
        $model->created_date = date("Y-m-d H:i:s");
        $model->SellerAccount = $accountant_num;
        $model->SellerVatRegCode =$CompanyData->reg_code;
        $model->SellerAccountant = $CompanyData->accountant;
        $model->SellerDirector = $CompanyData->director;

        if ($model->load(Yii::$app->request->post())) {{

            $model->FacturaId = $this->getId();
            $model->type_doc = DocInData::SEND_DOC;
            $model->FacturaProductId = $this->getId();
            $model->AgentFacturaId = $this->getId();
            $model->save();
            $itemsData = Json::decode($model->json_items);
            $k=0;
            foreach ($itemsData as $items){
                $k++;
                $data = new DocProducts();
                $data->company_id = Components::GetId();
                $data->doc_id = $model->id;
                $data->SortOreder = $k;
                $data->ProductName = $items['ProductName'];
                $data->ProductMeasureId = (string)$items['ProductMeasureId'];
                $data->ProductCount =(string) $items['ProductCount'];
                $data->ProductSumma = (string)$items['ProductSumma'];
                $data->ProductDeliverySum =(string)$items['ProductDeliverySum'];
                $data->ProductVatRate =(string) $items['ProductVatRate'];
                $data->ProductVatSum = (string)$items['ProductVatSum'];
                $data->ProductDeliverySumWithVat = (string)$items['ProductDeliverySumWithVat'];
                $data->ProductFuelRate = (string)$items['ProductFuelRate'];
                $data->ProductFuelSum = (string)$items['ProductFuelSum'];
                $data->ProductDeliverySumWithFuel= (string)$items['ProductDeliverySumWithFuel'];
                if(!$data->save()){
                    Yii::$app->session->setFlash('danger', Json::encode($data->getErrors()));
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
        }
            return $this->redirect(['view', 'id' => $model->id]);
        }
 
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateAksiz()
    {
//        echo phpinfo();die;
        $model = new Docs();
        $accountant_num = "";
        $mfo = "";
        $acountant = CompanyInvoicesHelpers::findOne(['company_id'=>Components::GetId()]);
        if(!empty($acountant)){
            $accountant_num = $acountant->invoices_number;
            $mfo = $acountant->mfo;
        }

//        $npdata = Components::getNp1(Components::CompanyData('tin'));
        $model->FacturaDate = date('Y-m-d');
        $model->ContractDate = date('Y-m-d');
        $model->company_id = Components::GetId();
        $model->SellerTin = Components::CompanyData('tin');
        $model->SellerName = Components::CompanyData('name');
        $model->SellerAddress = Components::CompanyData('address');
        $model->SellerOked = Components::CompanyData('oked');
        $model->SellerBankId = $mfo;
        $model->status = 1;
        $model->created_date = date("Y-m-d H:i:s");
        $model->SellerAccount = $accountant_num;
        $nds = Components::getNdsCode($model->SellerTin,'regCode');
        $model->SellerVatRegCode =$nds['result'];
//        $model->SellerBankId = $mfo;
        $model->SellerAccountant = Components::CompanyData('accountant');
        $model->SellerDirector = Components::CompanyData('director');
//        $excel = new Excel();
        if ($model->load(Yii::$app->request->post())) {{

            $model->FacturaId = $this->getId();
            $model->type_doc = DocInData::SEND_DOC;
            $model->FacturaProductId = $this->getId();
            $model->AgentFacturaId = $this->getId();
            $model->save();
            $itemsData = Json::decode($model->json_items);
            $k=0;
            foreach ($itemsData as $items){
                $k++;
                $data = new DocProducts();
                $data->company_id = Components::GetId();
                $data->doc_id = $model->id;
                $data->SortOreder = $k;
                $data->ProductName = $items['ProductName'];
                $data->ProductMeasureId = (string)$items['ProductMeasureId'];
                $data->ProductCount =(string) $items['ProductCount'];
                $data->ProductSumma = (string)$items['ProductSumma'];
                $data->ProductDeliverySum =(string)$items['ProductDeliverySum'];
                $data->ProductVatRate =(string) $items['ProductVatRate'];
                $data->ProductVatSum = (string)$items['ProductVatSum'];
                $data->ProductDeliverySumWithVat = (string)$items['ProductDeliverySumWithVat'];
                $data->ProductFuelRate = (string)$items['ProductFuelRate'];
                $data->ProductFuelSum = (string)$items['ProductFuelSum'];
                $data->ProductDeliverySumWithFuel= (string)$items['ProductDeliverySumWithFuel'];
                if(!$data->save()){
                    Yii::$app->session->setFlash('danger', Json::encode($data->getErrors()));
                    return $this->render('updateAksiz', [
                        'model' => $model,
                    ]);
                }
            }
        }
            return $this->redirect(['viewAksiz', 'id' => $model->id]);
        }

        return $this->render('createAksiz', [
            'model' => $model,
        ]);
    }

    public function actionAlcohol()
    {
//        echo phpinfo();die;
        $model = new Docs();
        $accountant_num = "";
        $mfo = "";
        $acountant = CompanyInvoicesHelpers::findOne(['company_id'=>Components::GetId()]);
        if(!empty($acountant)){
            $accountant_num = $acountant->invoices_number;
            $mfo = $acountant->mfo;
        }

//        $npdata = Components::getNp1(Components::CompanyData('tin'));

        $model->company_id = Components::GetId();
        $model->SellerTin = Components::CompanyData('tin');
        $model->SellerName = Components::CompanyData('name');
        $model->SellerAddress = Components::CompanyData('address');
        $model->SellerOked = Components::CompanyData('oked');
        $model->status = 1;
        $model->created_date = date("Y-m-d H:i:s");
        $model->SellerAccount = $accountant_num;
//        $model->SellerBankId = $mfo;
        $model->SellerAccountant = Components::CompanyData('accountant');
        $model->SellerDirector = Components::CompanyData('director');
//        $excel = new Excel();
        if ($model->load(Yii::$app->request->post())) {{

            $model->FacturaId = $this->getId();
            $model->type_doc = DocInData::SEND_DOC;
            $model->FacturaProductId = $this->getId();
            $model->AgentFacturaId = $this->getId();
            $model->save();
            $itemsData = Json::decode($model->json_items);
            $k=0;
            foreach ($itemsData as $items){
                $k++;
                $data = new DocProducts();
                $data->company_id = Components::GetId();
                $data->doc_id = $model->id;
                $data->SortOreder = $k;
                $data->ProductName = $items['ProductName'];
                $data->ProductMeasureId = (string)$items['ProductMeasureId'];
                $data->ProductCount =(string) $items['ProductCount'];
                $data->ProductSumma = (string)$items['ProductSumma'];
                $data->ProductDeliverySum =(string)$items['ProductDeliverySum'];
                $data->ProductVatRate =(string) $items['ProductVatRate'];
                $data->ProductVatSum = (string)$items['ProductVatSum'];
                $data->ProductDeliverySumWithVat = (string)$items['ProductDeliverySumWithVat'];
                $data->ProductFuelRate = (string)$items['ProductFuelRate'];
                $data->ProductFuelSum = (string)$items['ProductFuelSum'];
                $data->ProductDeliverySumWithFuel= (string)$items['ProductDeliverySumWithFuel'];
                if(!$data->save()){
                    Yii::$app->session->setFlash('danger', Json::encode($data->getErrors()));
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
        }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('alcohol', [
            'model' => $model,
        ]);
    }

    public function actionReestr()
    {
        $model = new ReestrMain();
        if ($model->load(Yii::$app->request->post())) {{

        }}

        return $this->render('createReestr', [
            'model' => $model,
        ]);
    }


    public function actionCreateXls()
    {
        $model = new Docs();
        $model->company_id = Components::GetId();
        $model->SellerTin = Components::CompanyData('tin');
        $model->SellerName = Components::CompanyData('name');
        $model->SellerAddress = Components::CompanyData('address');
        $model->SellerOked = 0;
        $model->status = 1;
        $model->created_date = date("Y-m-d H:i:s");
        $model->SellerAccount = Components::CompanyData('accountant');
        $model->SellerDirector = Components::CompanyData('director');

        if ($model->load(Yii::$app->request->post())) {{
            $FacturaID = $this->getId();
            $FacturaID = Json::decode($FacturaID);
            if($FacturaID['success']){
                $model->FacturaId = $FacturaID['data'];
            }
            $model->type_doc = 1;
            $model->save();
//            $itemsData = Json::decode($model->json_items);
//            $k=0;
//            foreach ($itemsData as $items){
//                $k++;
//                $data = new DocProducts();
//                $data->company_id = Components::GetId();
//                $data->doc_id = $model->id;
//                $data->SortOreder = $k;
//                $data->ProductName = $items['ProductName'];
//                $data->ProductMeasureId = $items['ProductMeasureId'];
//                $data->ProductCount = $items['ProductCount'];
//                $data->ProductSumma = round($items['ProductSumma']);
//                $data->ProductFuelSum =round($items['ProductFuelSum']);
//                $data->ProductVatRate = $items['ProductVatRate'] ;
//                $data->ProductVatSum = round($items['ProductVatSum']);
//                $data->ProductDeliverySum = round($items['ProductDeliverySum']);
//                if($data->save()){
////                    var_dump($data->getErrors());die;
//                }
//            }
        }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Docs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
//            echo $model->HasFuel;die;
            if($model->save()) {

                $itemsData = Json::decode($model->json_items);
                $k = 0;
                DocProducts::deleteAll(['company_id' => Components::GetId(), 'doc_id' => $model->id]);
                foreach ($itemsData as $items) {
                    $k++;
                    $data = new DocProducts();
                    $data->company_id = Components::GetId();
                    $data->doc_id = $model->id;
                    $data->SortOreder = $k;
                    $data->ProductName = $items['ProductName'];
                    $data->ProductMeasureId = (string)$items['ProductMeasureId'];
                    $data->ProductCount =(string)$items['ProductCount'];
                    $data->ProductSumma = (string)$items['ProductSumma'];
                    $data->ProductDeliverySum =(string) $items['ProductDeliverySum'];
                    $data->ProductVatRate =(string) $items['ProductVatRate'];
                    $data->ProductVatSum = (string)$items['ProductVatSum'];
                    $data->ProductDeliverySumWithVat = (string)$items['ProductDeliverySumWithVat'];
                    $data->ProductFuelRate = (string)$items['ProductFuelRate'];
                    $data->ProductFuelSum = (string)$items['ProductFuelSum'];
                    $data->ProductDeliverySumWithFuel = (string)$items['ProductDeliverySumWithFuel'];
                    if (!$data->save()) {
                        Yii::$app->session->setFlash('danger', Json::encode($data->getErrors()));
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }
            } else {
                Yii::$app->session->setFlash('danger', Json::encode($model->getErrors()));
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSwitchType(){
        $id = Yii::$app->request->post('id',null);
        $type = Yii::$app->request->post('type');
        if($id==null)
            $model = new Docs();
        else
            $model = Docs::findOne(['id'=>$id]);
        if($type==1) {
            $file = "_gridWithFuel";
        }
        else {
            $file = "_gridWithOutFuel";
        }
        $result =[
           'success'=>true,
            'test'=>$file,
           'html'=>$this->renderPartial($file,['model'=>$model])
        ];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }


    /**
     * Deletes an existing Docs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Docs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Docs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Docs::findOne(['id'=>$id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
