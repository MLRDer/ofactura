<?php
namespace cabinet\models;

use common\models\Banks;
use common\models\Company;
use common\models\CompanyTarif;
use common\models\CompanyTarifLog;
use common\models\Invoices;
use common\models\MonthPay;
use common\models\Notifications;
use Yii;
use yii\helpers\Json;

class Components
{
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";

    const HOST_ROUMING = "https://factura.yt.uz";
    const ROUMING_LOGIN = "onlinefactura";
    const ROUMING_PASSWORD = "n;xw3CE(GDb$@|D*";

    public static function CheckOnline($tin){
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            )
        );

        $context = stream_context_create($opts);
        $url = Yii::$app->params['factura_host']."/provider/api/uz/register/providerbinding/".$tin;
        return file_get_contents($url, false, $context);
    }

    public static function CompanyData($key){
        $session = Yii::$app->session;
        $result = "";
//        if($session->get('company_'.$key)!=""){
//            $result = $session->get('company_'.$key);
//        }
        if($result==""){
            $id = Components::GetId();
            if($id==0){
                $result = null;
            }
        }
        if($result==""){
            $model = \common\models\Company::findOne(['id'=>$id]);
//                $session->set("company_" . $key, $model[$key]);
                $result = $model[$key];
        }
        if($result==""){
            $result = null;
        }

        return $result;
    }


    public static function GetCompanyIdByTin($tin){
        $model = Company::findOne(['tin'=>$tin]);
        $result = 0;
        if(!empty($model))
            $result = $model->id;
        return $result;
    }

    public static function getFacturaID(){
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
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

    public static function GetId(){

        $reason="";
        $session = Yii::$app->session;
        $id = 0;
        if($session->get('company_id')!==null){
            $id = $session->get('company_id');
//            echo "1 - ";die;
        } else {
//            echo "2 - ";die;
            $model = \common\models\CompanyUsers::findOne(['users_id'=>Yii::$app->user->id,'enabled'=>1]);
            if(empty($model)){
                $reason = "Foydalanuvchiga Korxona biriktirilmagan";
            }
            if($reason==""){
                $company = \common\models\Company::findOne(['id'=>$model->company_id]);
                if(empty($company)){
                    $reason = "Bunday Korxona mavjud emas";
                }
            }
            if($reason==""){
                $session->set('company_id',$company->id);
                $id = $company->id;
            }
        }
        if($reason!==""){
//            echo $reason;die;
        }
        return $id;
    }

    public static function GetIdByTin($tin){
        $model = Company::findOne(['tin'=>$tin]);
        return $model['id'];
    }

    public static function getCountDoc(){
        $model = CompanyTarifLog::find()->andWhere(['company_id'=>Components::GetId()])->all();
        $result = 0;
            foreach ($model as $items){
                $result += $items->remain_value;
            }
        return $result;
    }


    public static function setMonthSum($sum){
        $month_sum = CompanyTarif::findOne(['id'=>1])->month_mony;
        $reason = "";
        if($sum>=$month_sum){
            $today = date('Y-m-d');
            $monthPay = new MonthPay();
            $monthPay->company_id = Components::GetId();
            $monthPay->value = $month_sum;
            $monthPay->created_date = $today;
            $monthPay->end_date = date('Y-m-d',strtotime($today." + 30 days"));
            $monthPay->enabled = 1;
            $monthPay->tarif_id = 1;
            if(!$monthPay->save()){
                $reason = Json::encode($monthPay->getErrors());
            } else {
                $invoices = new Invoices();
                $invoices->company_id = Components::GetId();
                $invoices->value = $month_sum;
                $invoices->reason = $monthPay->created_date." dan  ".$monthPay->end_date." gacha oylik to'lov yechib olindi";
                $invoices->created_date = date('Y-m-d H:i:s');
                $invoices->type_invoices =Invoices::INVOICES;
                $invoices->status = 1;
                $invoices->enabled = 1;
               if(!$invoices->save()){
                   $reason = Json::encode($invoices->getErrors());
               } else {
                   $company_sum = Company::findOne(['id'=>Components::GetId()]);
                   $company_sum->invoices_sum = $company_sum->invoices_sum - $month_sum;
                   $company_sum->save();
               }
            }
        } else {
            $reason = "Hisobingizda oylik to'lov uchun yetarli mablag' mavjud emas";
        }
        return $reason;
    }

    public static function getNotifiy($type){
        $model = Notifications::find()->andWhere(['tin'=>self::CompanyData('tin'),'is_view'=>1,'type'=>Notifications::TYPE_FACTURA])->count();
        if($model!=0)
            return '<span class="badge green">'.$model.'</span>';
        else
            return "";
    }

    public static function getSum(){
        $model = Company::findOne(['id'=>Components::GetId()]);
        $result = 0;
        if($model["invoices_sum"]!=null){
            $result = $model["invoices_sum"];

        }
        return $result;
    }

    public static function getNdsCode($tin,$key='all'){
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode("onlinefactura:9826315157e93a13e05$")
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $context = stream_context_create($opts);

        $url = "https://my.soliq.uz/services/nds/reference?tin=".$tin;
        if($key=="all"){
            return file_get_contents($url, false, $context);
        } else{
            $result = [
                'error'=>"",
                'result'=>""
            ];
            $data = file_get_contents($url, false, $context);
            $data = Json::decode($data);
            $result['success'] = $data['success'];
            if($data['success']==true){
                $data = $data['data'];
                if(isset($data[$key])) {
                    $result['result'] = $data[$key];
                    } else{
                    $result['error']="NDS:Bunday formatli malumot mavjud emas";
                }
            } else {
                $result['error'] = "NDS:Malumot yetib kelmadi";
            }
            return $result;
        }
    }

    public static function getTarif($key='name'){
        $model = CompanyTarifLog::findOne(['company_id'=>Components::GetId()]);
        $result = "---";
        if(!empty($model)){
            $tarif = CompanyTarif::findOne(['id' => $model->tarif_id]);
            $result=$tarif[$key];
        }
        return $result;
    }


    public static function getNp1($tin){

        $opts = array(
            'http' => array(
                'timeout'=>5,
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode("onlinefactura:9826315157e93a13e05$")
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $context = stream_context_create($opts);

        $url = "https://my.soliq.uz/services/np1/bytin/factura?lang=uz&tin=".$tin;
        return file_get_contents($url, false, $context);
    }

    public static function getFizNp1($tin){

        $opts = array(
            'http' => array(
                'timeout'=>5,
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode("onlinefactura:9826315157e93a13e05$")
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $context = stream_context_create($opts);
        $url = "https://my.soliq.uz/services/np1/phisbytin/factura?lang=uz&tin={$tin}";

        return file_get_contents($url, false, $context);
    }

    public static function getBranch($tin){

        $opts = array(
            'http' => array(
                'timeout'=>5,
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode("onlinefactura:9826315157e93a13e05$")
            ),
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $context = stream_context_create($opts);
        $url = "https://my.soliq.uz/services/yur-branchs/getdatabytin?tin={$tin}";

        $data = Json::decode(file_get_contents($url, false, $context));
        $result ="<option value=''>".Yii::t('main','Filialni tanlang...')."</option>";
        foreach ($data as $items){
            $result.="<option value='".$items['branchNum']."'>".$items['branchName']."</option>";
        }
        return $result;
    }

    public static function getBankName($bankd_id,$type="one"){
        $model = Banks::findOne(['bankId'=>$bankd_id]);
        if(empty($model)) {
            $opts = array(
                'http' => array(
                    'timeout' => 5,
                    'method' => "GET",
                    'header' => "Authorization: Basic " . base64_encode(self::ROUMING_LOGIN . ":" . self::ROUMING_PASSWORD)
                ),
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $context = stream_context_create($opts);
            if($type=="one") {
                $url = self::HOST_ROUMING . "/provider/api/uz/catalogs/bank/" . $bankd_id;
                $data = Json::decode(file_get_contents($url, false, $context));
                    $dataBnk = new Banks();
                    $dataBnk->bankId = $data['bankId'];
                    $dataBnk->Name = $data['name'];
                    $dataBnk->enabled;
                    if($dataBnk->save()){
                        $model = $dataBnk;
                    }

            } else {
                $url = self::HOST_ROUMING . "/provider/api/uz/catalogs/bank";
                $data = Json::decode(file_get_contents($url, false, $context));
                Banks::deleteAll();
                foreach ($data as $items) {
                    $dataBnk = new Banks();
                    $dataBnk->bankId = $items['bankId'];
                    $dataBnk->Name = $items['name'];
                    $dataBnk->enabled;
                    if ($dataBnk->save()) {
                        $model = Banks::findOne(['bankId' => $bankd_id]);
                    }
                }
            }

        }
        return $model->Name;
    }
}