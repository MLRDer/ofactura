<?php
namespace console\controllers;

use BaconQrCode\Common\EcBlock;
use cabinet\models\Components;
use common\models\Acts;
use common\models\BankInvoicesLog;
use common\models\CallbackFile;
use common\models\Company;
use common\models\Districts;
use common\models\DocInData;
use common\models\FacturaPks7;
use common\models\Facturas;
use common\models\Invoices;
use common\models\Notifications;
use common\models\SynsJobs;
use Yii;
use yii\helpers\Json;
use yii\web\Response;

/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-20
 * Time: 10:56
 */

class ConsoleController extends \yii\console\Controller
{

    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";

    const URL_PKCS = "http://127.0.0.1:9090/dsvs/pkcs7/v1?wsdl";

    public function actionSyns(){
        $model = SynsJobs::find()->andWhere(['enabled'=>1])->all();
        foreach ($model as $item){
            echo $item->tin."\n";
            $data = $this->buyerData($item);
            $this->SetData($data);
        }
    }

    public function actionApiClear(){
        $model = DocInData::find()->andWhere(['type'=>1])->all();
        echo "Begin clear DocInData...\n";
        foreach ($model as $items){
            $reason = "";
            $data = $items->doc_data;
            echo "ID:{$items->id } \n";
            try {
                $factura = $this->ProcessingReceivedData($data);
                $facturaUpper = $this->ValidateFacturaData($factura);
                $this->InsertInFactura($facturaUpper);
                $data = Json::decode($data);
                $this->InsertPks($facturaUpper['FACTURAID'],$data['Sign']);

            } catch (\Exception $exception){
                echo 'Caught exception: ',  $exception->getMessage(), "\n";

            }
            DocInData::deleteAll(['id'=>$items->id]);
        }
    }


    public function actionPay(){
        $token = Yii::$app->params['bank_api']['token'];
        header('Content-Type: application/json'); // Specify the type of data
        $ch = curl_init('http://accountapi.aloqabank.uz:5690/api/account/transactions'); // Initialise cURL
        $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization )); // Inject the token into the header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 0); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        $result = curl_exec($ch); // Execute the cURL statement
        curl_close($ch); // Close the cURL connection
        echo "Begin...\n";
        $model = Json::decode($result);
        if(isset($model['data'])){
            foreach ($model['data'] as $items){
                $checkLog = BankInvoicesLog::findOne(['id'=>$items['id']]);

                if(empty($checkLog)) {
                    echo "New data!!!\n";
                    $data = new BankInvoicesLog();
                    $data->id = $items['id'];
                    $data->docId = $items['docId'];
                    $data->docNumb = $items['docNumb'];
                    $data->currDay = $items['currDay'];
                    $data->codeFilial = $items['codeFilial'];
                    $data->clMfo = $items['clMfo'];
                    $data->clAcc = $items['clAcc'];
                    $data->clInn = $items['clInn'];
                    $data->clName = $items['clName'];
                    $data->coMfo = $items['coMfo'];
                    $data->coAcc = $items['coAcc'];
                    $data->coInn = $items['coInn'];
                    $data->coName = $items['coName'];
                    $data->payPurpose = $items['payPurpose'];
                    $data->sumPay = $items['sumPay'];
                    $data->state = $items['state'];
                    $data->operationId = $items['operationId'];
                    $data->type = ($items['clInn'] !== "306717486") ? 1 : 0;
                    $data->enabled = 0;
                    $key = substr($data->payPurpose,0,5);
                    if ($key== "00668" && $data->type==1) {
                        $check = Invoices::findOne(['bank_data_id' => $items['id']]);
                        if (empty($check)) {
                            echo $items['clInn']." - ".$items['sumPay'] / 100;
                            echo "\n";
                            $invoicesModel = new Invoices();
                            $invoicesModel->company_id = Components::GetCompanyIdByTin($items['clInn']);
                            $invoicesModel->tin = $items['clInn'];
                            $invoicesModel->bank_data_id = $items['id'];
                            $invoicesModel->reason = "Bank orqali xisobni to`ldirish amalga oshirildi";
                            $invoicesModel->type_invoices = 1;
                            $invoicesModel->created_date = date('Y-m-d H:i:s');
                            $invoicesModel->value = $items['sumPay'] / 100;
                            $invoicesModel->type_pay = 2;
                            $invoicesModel->enabled = 1;
                            $invoicesModel->save();
                        }
                    }
                    if ($data->save()) {

                    }
                } else {
                    echo "We have data\n";
                }
            }
        }
    }

    public function actionClearDoc(){
        $model = DocInData::find()->where("reason is null and enabled=0 and type=1")->limit(500)->all();
        echo "Boshlandi. \n";
        foreach ($model as $items){
            $reason="";
            echo $items->id."\n";
            $data = Json::decode($items['doc_data']);
            $client = new \SoapClient(self::URL_PKCS);
            $result = $client->verifyPkcs7([ "pkcs7B64" =>$data['Sign']]);
            $result = $result->return;
            $result = Json::decode($result);
            $factura =  $result['pkcs7Info'];
            $factura = $factura['documentBase64'];
            $factura = base64_decode($factura);
            $factura = Json::decode($factura);
            if(!isset($factura['ProductList'])){
                $reason = "Tovarni listok mavjud emas";
            }

            if($reason==""){
                $company_id = Company::findOne(['tin' => $factura['BuyerTin'], 'is_aferta' => 1]);
                if(empty($company_id)){
                    $reason="Companya bizga tegishli emas";
                }
            }

            if($reason!==""){
                echo $reason."\n";
                DocInData::findOne(['id'=>$items->id])->delete();

            }
        }
        echo "Tugadi. \n";
    }

    public function actionReserv(){
        $model = \common\models\Docs::find()->where('enabled is null')->andWhere(['status'=>3])->all();
        echo "Begin Archived data ...\n";
        foreach ($model as $items){
            echo "*";
            if($items->type_doc==1){
                $folder = $items->BuyerTin;
                $filename = "Send_".$items->FacturaId."-".date('d-m-YHis',strtotime($items->created_date));
            } else {
                $folder = $items->SellerTin;
                $filename = "Reseved_".$items->FacturaId."-".date('d-m-YHis',strtotime($items->created_date));
            }
            $path_name = "../archived/".$folder;
            mkdir($path_name,777,true);
            $path_name = $path_name."/".$filename;
            $fp = fopen($path_name, 'w') or die("can't open file");
            if(fwrite($fp, \yii\helpers\Json::encode($items))) {
                $checkEnabled = \common\models\Docs::findOne(['id' => $items->id]);
                $checkEnabled->enabled = 1;
                if (!$checkEnabled->save()) {
                    echo "Error saved:" . \yii\helpers\Json::encode($checkEnabled->getErrors());
                }
            } else {
                echo "Cannot write data";
            }
            fclose($fp);
        }
    }

    public function actionCheckConnection(){
        ini_set('memory_limit', '1024M');
        $model = Company::find()->andWhere(['is_aferta'=>1])->all();
        echo "Begin Check status ...\n";
        foreach ($model as $items){
            echo "COMPANY TIN:".$items->tin.". STATUS:";
            $check = $this->CheckConnection($items->tin);
            $check = Json::decode($check);
            if(isset($check['providers'])){
                $sts = "FALSE\n";
                foreach ($check['providers'] as $itemsProviders){

                    if($itemsProviders['providerTin']=="306717486" && $itemsProviders['enabled']==true){
                        $sts = "TRUE\n";
                        $CheckModel = Company::findOne(['id'=>$items->id]);
                        $CheckModel->is_online = 1;
                        if(!$CheckModel->save()){
                            echo Json::encode($CheckModel->getErrors());
                        }
                    } else {

                    }
                }
                echo $sts;
            }
        }
        echo "END. \n";
        return "";
    }

    public function actionGetRegion()
    {

        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN . ":" . self::PASSWORD)
            )
        );
        $reason = "";
        $context = stream_context_create($opts);
        $url = self::HOST . "/provider/api/uz/catalogs/region";
        $data = file_get_contents($url, false, $context);
        $data = Json::decode($data);
        echo "Boshlandi. \n";
        foreach ($data as $items) {
            $model = Districts::findOne(['region_id' => $items['regionId']]);
            if (empty($model)) {
                $model = new Districts();
            }
            $model->region_id = $items['regionId'];
            $model->name_uz = $items['name'];
            $ditrict_code = sprintf("%02d", $items['regionId']) . "00";
            $model->district_id = $ditrict_code;
            $model->ditrict_code = $items['regionId'];
            $model->name_ru = $items['name'];
            $model->enabled = 1;
            if (!$model->save()) {
                echo Json::encode($model->getErrors());
            } else {
                echo ".";
            }

        }
        echo "\n";
        echo "Tugadi. \n";
    }

//    public function actionCreateFacturaPksSingleTxt(){
//        $factura_id = $_POST['factura_id'];
//        $seller_pks7 = $_POST['seller_pks7'];
//        try {
//            if (!file_exists("./assets/factura_pks7")){
//                mkdir("./assets/factura_pks7", 0777, true);
//            }
//            if (isset($factura_id) && isset($seller_pks7)){
//                $file = fopen(__DIR__.'/../../assets/factura_pks7/'.$factura_id.".txt", "w");
//                fwrite($file, $seller_pks7);
//                fclose($file);
//
//                return json_encode(["message"=>"saved!"]);
//            }
//            return json_encode(["message"=>"factura_id or seller_pks7 fild is missing"]);
//        }
//        catch (\Exception $exception){
//            return $exception->getMessage();
//        }
//    }

    public function actionCreateFacturaPksTxt(){
        $factura_pks = FacturaPks7::find()
            ->select('factura_pks7.*, facturas.SellerTin, facturas.BuyerTin')
            ->join('inner join', 'facturas', 'facturas.Id=factura_pks7.factura_id')
            ->asArray()
            ->all();

//        var_dump($factura_pks);
//        die();

        $base_seller_path = "./cabinet/web/factura_pks7/seller";
        $base_buyer_path = "./cabinet/web/factura_pks7/buyer";

        try {
            if (!file_exists($base_seller_path)){
                mkdir($base_seller_path, 0777, true);
            }
            if (!file_exists($base_buyer_path)){
                mkdir($base_buyer_path, 0777, true);
            }

//            var_dump($factura_pks);
//            die();

            foreach ($factura_pks as $factura_pk){
                if (!file_exists($base_seller_path ."/". $factura_pk['SellerTin'])){
                    mkdir($base_seller_path."/".$factura_pk['SellerTin'], 0777, true);
                }
//                echo $factura_pk->seller_pks7;
//                echo  $factura_pk->SellerTin;
                if(isset($factura_pk['seller_pks7'])){

                    $file = fopen(__DIR__.'/../../cabinet/web/factura_pks7/seller/'.$factura_pk['SellerTin'].'/'.$factura_pk['factura_id'].".txt", "w");
                    fwrite($file, $factura_pk['seller_pks7']);
                    fclose($file);
                }

                if (!file_exists($base_buyer_path ."/". $factura_pk['BuyerTin'])){
                    mkdir($base_buyer_path."/".$factura_pk['BuyerTin'], 0777, true);
                }
                if(isset($factura_pk['buyer_pks7'])){

                    $file = fopen(__DIR__.'/../../cabinet/web/factura_pks7/buyer/'.$factura_pk['BuyerTin'].'/'.$factura_pk['factura_id'].".txt", "w");
                    fwrite($file, $factura_pk['buyer_pks7']);
                    fclose($file);
                }

            }
            echo "Success!";
            //return json_encode(['success'=>true, 'facturas'=>$factura_pks]);
        }
        catch (\Exception $exception){
            echo $exception->getMessage();
        }

    }

    public function actionActJob(){
        echo "Boshlandi \n";
        $model = CallbackFile::find()->andWhere(['type'=>CallbackFile::TYPE_ACT,'status'=>CallbackFile::STATUS_NEW])->all();

        $is_delete = 0;
        foreach ($model as $items){
            $callbackModel = CallbackFile::findOne(['id'=>$items->id]);
            echo $items->id;
            $reason="";
            $file_path = Yii::getAlias("@cabinet")."/web/".$items->path;
            if(!file_exists($file_path)){
                $reason = "Fayl topilmadi: ".$file_path;
            }
            if($reason==""){
                $data = self::GetJsonBySign(file_get_contents($file_path));
                $dataUpper = self::UpperKeyName($data);
                  if($items->type_action==CallbackFile::ACTION_RECEIVED) {
                      echo "TYPE_ACTION:". $items->type_action;
                      if (isset($dataUpper)) {
                          $checkAct = Acts::findOne(['Id'=>$dataUpper['ACTID']]);
                          if(empty($checkAct)) {
                              $insertAct = new Acts();
                              $insertAct->InsertByArray($dataUpper);
                              $insertAct->InsertActProducts($dataUpper);
                              if (!$insertAct->save()) {
                                  $reason = Json::encode($insertAct->getErrors());
                              } else {
                                  $is_delete = 1;
                                  $checkAct  = $insertAct;
                              }
                          } else {
                              $is_delete = 1;
                          }

                          $data = new Notifications();
                          $data->tin = $checkAct->BuyerTin;
                          $data->type = Notifications::TYPE_ACT_RECEIVED;
                          $data->doc_id = $checkAct->Id;
                          $data->title_uz = "Входящий акты № ".$checkAct->ActNo;
                          $data->title_ru = "Входящий акты № ".$checkAct->ActNo;
                          $data->anons_uz = $checkAct->ActText;
                          $data->anons_ru =  $checkAct->ActText;
                          $data->path = "/act/view?id=".$checkAct->Id;
                          $data->is_view = Notifications::NOT_VIEW;
                          $data->save();


                      } else {
                          $reason = "Faylda ACT mavjud emas";
//                          var_dump($dataUpper);
                      }
                  }
                if($items->type_action==CallbackFile::ACTION_ACCEPT) {
                    $modelAct = Acts::findOne(['Id'=>$dataUpper['ACTID']]);
                    if(!empty($modelAct)){
                        $modelAct->status = Acts::STATUS_ACCEPTED;
                        if(!$modelAct->save()){
                            $reason = Json::encode($modelAct->getErrors());

                        } else {
                            $is_delete = 1;
//                            $data = new Notifications();
//                            $data->tin = $checkAct->BuyerTin;
//                            $data->type = Notifications::TYPE_ACT_RECEIVED;
//                            $data->doc_id = $checkAct->Id;
//                            $data->title_uz = "Пн акты № ".$checkAct->ActNo;
//                            $data->title_ru = "Входящий акты № ".$checkAct->ActNo;
//                            $data->anons_uz = $checkAct->ActText;
//                            $data->anons_ru =  $checkAct->ActText;
//                            $data->path = "/act/view?id=".$checkAct->Id;
//                            $data->is_view = Notifications::NOT_VIEW;
//                            $data->save();
                        }

                    } else {
                        $is_delete = 1;
//                        $reason = "Bizning tizimda BUnday ID li akt mavjud emas";
                    }
//                    var_dump($dataUpper);die;
                }
                if($items->type_action==CallbackFile::ACTION_REJECT) {

                    $notes = $dataUpper['NOTES'];
                    $dataUpper =$dataUpper['ACT'];
                    $modelAct = Acts::findOne(['Id'=>$dataUpper['ACTID']]);
                    if(!empty($modelAct)){
                        $modelAct->status = Acts::STATUS_REJECTED;
                        $modelAct->notes = $notes;
                        if(!$modelAct->save()){
                            $reason = Json::encode($modelAct->getErrors());

                        } else {
                            $is_delete = 1;
                        }

                    } else {
                        $is_delete = 1;
//                        $reason = "Bizning tizimda BUnday ID li akt mavjud emas";
                    }
//                    var_dump($dataUpper);die;
                }

                if($items->type_action==CallbackFile::ACTION_CANCELED) {
//                    var_dump($dataUpper);die;
                    $modelAct = Acts::findOne(['Id'=>$dataUpper['ACTID']]);
                    if(!empty($modelAct)){
                        $modelAct->status = Acts::STATUS_CANCELLED;
                        if(!$modelAct->save()){
                            $reason = Json::encode($modelAct->getErrors());
                        } else {
                            $is_delete = 1;
                        }
                    }

                }



            }
            if($reason==""){
                if($is_delete==1){
                    unlink($file_path);
                    $callbackModel->delete();
                }
                echo "Success.\n";
            }
            else{
                $callbackModel->status = CallbackFile::STATUS_ERROR ;
                $callbackModel->reason = $reason;
                $callbackModel->save();
                echo $reason."\n";
            }



        }
    }



    protected static  function GetJsonBySign($data){
        $data = Json::decode($data);
        $client = new \SoapClient(self::URL_PKCS);
        $result = $client->verifyPkcs7([ "pkcs7B64" =>$data['Sign']]);
        $result = $result->return;
        $result = Json::decode($result);
        $doc =  $result['pkcs7Info'];
        $doc = $doc['documentBase64'];
        $doc = base64_decode($doc);
        $doc = Json::decode($doc);
        return $doc;
    }

    protected static function UpperKeyName($doc){
        $UpperData =[];
        foreach ($doc as $key=>$value){
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
                                $UpperData[mb_strtoupper($key)][mb_strtoupper($key2)][mb_strtoupper($key3)] = $arra4;
//                                }
                            } else {
                                $UpperData[mb_strtoupper($key)][mb_strtoupper($key2)][mb_strtoupper($key3)] = $value3;
                            }
                        }
                    } else {
//                        echo $key2."=>".$value2."\n";
                        $UpperData[mb_strtoupper($key)][mb_strtoupper($key2)] = $value2;
                    }

                }
            } else {
                $UpperData[mb_strtoupper($key)] = $value;
//                echo $key."=>".$value."\n";
            }
        }

//        echo Json::encode($UpperFactura);
        return $UpperData;
    }


//    public function actionGetFacturaPksTxt(){
//        try {
//            if (isset($_GET['factura_id'])){
//                $factura_id = $_GET['factura_id'];
//                if (file_exists(__DIR__.'/../../assets/factura_pks7/'.$factura_id.".txt")){
//
//                    $file = fopen(__DIR__.'/../../assets/factura_pks7/'.$factura_id.".txt", "r");
//                    clearstatcache(true, __DIR__.'/../../assets/factura_pks7/'.$factura_id.".txt");
//                    $content = fread($file, filesize(__DIR__.'/../../assets/factura_pks7/'.$factura_id.".txt"));
//
//                    fclose($file);
//
//                    return json_encode(['content'=>$content]);
//                }
//                else{
//                    return json_encode(["content"=>"No file found!"]);
//                }
//            }
//        }
//        catch (\Exception $exception){
//            return $exception->getMessage();
//        }
//    }

    public function actionGetDistrict(){

        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            )
        );
        $reason ="";
        $context = stream_context_create($opts);
        $url = self::HOST."/provider/api/uz/catalogs/district";
        $data = file_get_contents($url, false, $context);
        $data = Json::decode($data);
        echo "Boshlandi. \n";
        foreach ($data as $items){
            $model = Districts::findOne(['district_id'=>$items['districtId']]);
            if(empty($model)) {
                $model = new Districts();
            }
            $model->region_id = $items['regionId'];
            $model->parent_region_id = $items['regionId'];
            $model->name_uz = $items['name'];
            $model->district_id = $items['districtId'];
            $model->ditrict_code= $items['districtCode'];
            $model->name_ru = $items['name'];
            $model->enabled = 1;
            if(!$model->save()){
                echo  Json::encode($model->getErrors());
            } else {
                echo ".";
            }


        }
        echo "\n";
        echo "Tugadi. \n";
    }

    protected function CheckConnection($tin){
        $ch = curl_init(self::HOST."/provider/api/uz/register/providerbinding/{$tin}");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERPWD, self::LOGIN . ":" . self::PASSWORD);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    protected function buyerData($model){
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            )
        );
        $context = stream_context_create($opts);
        $url = Yii::$app->params['factura_host']."/provider/api/uz/{$model->tin}/facturas/buyer?fromCreated=2020-01-01&toCreated=2020-08-01&pageNumber=0&pageLimit=1000&stateId=17";
        $data = file_get_contents($url, false, $context);
        return $data;
    }

    protected function SetData($data){
        $data = Json::decode($data);
        if(isset($data['rows'])){
            echo "Boshlandi\n";
            foreach ($data['rows'] as $items){

                $items = $this->ValidateFacturaData($items);
                $check = Facturas::findOne(['Id'=>$items['FACTURAID']]);
                if(empty($check)) {
                    echo "Facatura ID:{$items['FACTURAID']} ... \n";
                    $model = new Facturas();
                    $model->InsertByConsole($items);
                    if($model->save()){
                        echo "Success saved!\n";
                    } else {
                        echo "Eror saved: ".Json::encode($model->getErrors());
                    }
                } else {
                    echo "Bunday faktura mavjud :)\n";
                }
            }
        }
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



    protected function InsertPks($facturaId, $data){
        $model = FacturaPks7::findOne(['factura_id'=>$facturaId]);
        if(empty($model))
            $model = new FacturaPks7();
        $model->factura_id = $facturaId;
        $model->seller_pks7 = $data;
        if(!$model->save()){
            var_dump($model->getErrors());die;
        }
    }

    protected function InsertInFactura($factura){
        $model = Facturas::findOne(['Id'=>$factura['FACTURAID']]);
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