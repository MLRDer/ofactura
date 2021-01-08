<?php
namespace cabinet\controllers;

use cabinet\models\Components;
use common\models\Banks;
use common\models\Company;
use common\models\CompanyInvoicesHelpers;
use common\models\CompanyUsers;
use common\models\ReestrMainSearch;
use common\models\User;
use common\models\Users;
use kartik\mpdf\Pdf;
use Yii;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
//25198
/**
 * Site controller
 */
class SiteController extends \cabinet\components\Controller
{
    /**
     * {@inheritdoc}
     */


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'auth' || $action->id == 'logout') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionMode(){
        $session = Yii::$app->session->get('mode','min');
        if($session=="min")
            Yii::$app->session->set('mode','max');
        else
            Yii::$app->session->set('mode','min');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSetRouming()
    {
        $this->layout = "mainAccept";
        return $this->render('index');

    }

    public function actionOferta(){
        $model = \common\models\Aferta::findOne(['id'=>1]);
        $content = $model['body_'.Yii::$app->language];
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

    public function actionIndex()
    {

//        echo  Yii::$app->language;die;
//        $tarif = Components::getTarif();
//        if($tarif=="---"){
//            Yii::$app->session->setFlash('warning', 'Amallarni davom ettirish uchun o`zinggizga maqul tarifni faolashtiring');
//            return $this->redirect('/doc/tarif');
//        }
        $searchModel = new ReestrMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId()]);

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAferta(){
        return $this->render('aferta');
    }


    public function actionNew()
    {
//        $this->layout = "mainNew";
        return $this->render('index');
    }



    /**
     * Login action.
     *
     * @return string
     */

    public function actionSignup()
    {


        return $this->render('signup');
    }
    public function actionLogin()
    {
        $this->layout = "mainLoginNew";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if (Yii::$app->request->post()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
                'guid'=>Yii::$app->security->generateRandomString(32)
            ]);
        }
    }


    public function actionGetBanks(){
        $model = new Banks();
        $model = $model->getBanks();
        foreach ($model as $items){
            $data = new Banks();
            $data->bankId = $items['bankId'];
            $data->Name = $items['name'];
            $data->enabled = 1;
            $data->save();
        }
    }

    public function actionAuth(){
        $keyId = Yii::$app->request->post('keyId');
        $guid = Yii::$app->request->post('guid');
        $pkcs7 = Yii::$app->request->post('pkcs7');
        $url ="http://127.0.0.1:9090/dsvs/pkcs7/v1?wsdl";
//        error_reporting(E_ALL);
//        ini_set("soap.wsdl_cache_enabled", "0");
////        $url ="http://googel.com";
//        echo file_get_contents($url);die;
//        return phpinfo();
        $client = new \SoapClient($url);
        $result = $client->verifyPkcs7([ "pkcs7B64" =>$pkcs7]);
        $model = $result->return;
        $reason = "";
        if(empty($model)){
            $reason="Malumot mavjud emas";
        }
        if($reason==""){
             $model = Json::decode($model);
        }

        if($model['success']==false){
            $reason = $model['reason'];
        }

        if($reason==""){
            $model = $model['pkcs7Info'];
            $signers = $model['signers'];
            $signers = $signers[0];
            $keyid_main = base64_decode($model['documentBase64']);
//            VarDumper::dump($signers[0],12,true);die;
            if($signers['verified']==false){
                $reason = "ЭЦП не действительна";
            }
        }

        if($guid!=$keyid_main){
            $reason = "Xatolik: auth id not nefined 1.-".$keyId." 2.-".$keyid_main;
        }

        if($reason==""){
            if($signers['certificateVerified']==false){
                $reason="цепочка сертификатов не действительна";
            }
        }

        if($reason==""){
            if(isset($signers['exception'])) {
                if ($signers['exception'] != "") {
                    $reason = "Ошибка:" . $signers['exception'];
                }
            }
        }
//        $users="";
        if($reason=="") {
            $certificate = $signers['certificate'];
            $subjectName = $certificate[0];
            $subjectName = $subjectName['subjectName'];
            $subjectData = explode(",", $subjectName);
            $subjectModel = [];
            foreach ($subjectData as $items) {
                $subjectItem = explode("=", $items);
                $subjectModel[$subjectItem[0]] = $subjectItem[1];
            }
            $users = User::findOne(['username' => $subjectModel['UID']]);
            if (empty($users)) {
                $users = new Users();
                $users->username = $subjectModel['UID'];
                $users->tin = $subjectModel['UID'];
                $users->fio = $subjectModel['CN'];
                $users->role_id = 1;
                $users->email = $subjectModel['UID'] . "@noname.no";
                $users->created_at = strtotime(date('Y-m-d H:i:s'));
                $users->updated_at = strtotime(date('Y-m-d H:i:s'));
                $users->status = 10;
                $users->auth_key = Yii::$app->security->generateRandomString(32);
                $users->password_hash = Yii::$app->security->generateRandomString(32);
                if (!$users->save()) {
                    $reason = Json::encode($users->getErrors());
                }
            }
        }


        if($reason==""){
            if(isset($subjectModel['1.2.860.3.16.1.1'])){
                $CompanyData = $this->getNp1($subjectModel['1.2.860.3.16.1.1']);
                $CompanyData = Json::decode($CompanyData);
                $company = Company::findOne(['tin'=>$subjectModel['1.2.860.3.16.1.1']]);
                if (empty($company)) {
                    $company = new Company();
                    $nds_code = Components::getNdsCode($subjectModel['1.2.860.3.16.1.1'],'regCode');
                    $company->name = $CompanyData['name'];
                    $company->parent_id = 0;
                    $company->tin = $subjectModel['1.2.860.3.16.1.1'];
                    $company->ns10_code = $CompanyData['ns10Code'];
                    $company->ns11_code = $CompanyData['ns11Code'];
                    $company->address = $CompanyData['address'];
                    $company->oked = $CompanyData['oked'];
                    $company->director_tin = $CompanyData['directorTin'];
                    $company->director = $CompanyData['director'];
                    $company->accountant = $CompanyData['accountant'];
                    $company->reg_code = ($nds_code['success']==true)?$nds_code['result']:"";
                    $company->mfo = $CompanyData['mfo'];
                    $company->status = 1;
                    $company->type = 1;
                    $company->enabled = 1;
                } else {
                    if($company->enabled==0){
                        $company->enabled =1;
                    }
                }
                if ($company->type == 1) {
                    $invoices_listy = CompanyInvoicesHelpers::find()->andWhere(['company_id'=>$company->id,'invoices_number'=>$CompanyData['account']])->one();
                    if(empty($invoices_listy)) {
                        $invoices_listy = new CompanyInvoicesHelpers();
                        $invoices_listy->company_id = $company->id;
                        $invoices_listy->name = $CompanyData['mfo'];
                        $invoices_listy->mfo = $CompanyData['mfo'];
                        $invoices_listy->invoices_number = $CompanyData['account'];
                        $invoices_listy->status = 1;
                        $invoices_listy->save();
                    }
                }
            } else {
                $company = Company::findOne(['tin'=>$subjectModel['UID']]);
                if(empty($company)) {
                    $company = new Company();
                    $company->name = $subjectModel['CN'];
                    $company->parent_id = 0;
                    $company->tin = $subjectModel['UID'];
                    $company->ns10_code = 0;
                    $company->ns11_code = 0;
                    $company->address = $subjectModel['L'] . " " . $subjectModel['ST'];
                    $company->status = 1;
                    $company->type = 2;
                    $company->enabled = 1;
                }
            }
            if(!$company->save()){
                $reason = Json::encode($company->getErrors());
            }
        }


        if($reason=="") {
            $companyUsers = CompanyUsers::find()->andWhere(['company_id' => $company->id, 'users_id' => $users->id, 'enabled' => 1])->one();
            if (empty($companyUsers)) {
                $companyUsers = new CompanyUsers();
                $companyUsers->company_id = $company->id;
                $companyUsers->users_id = $users->id;
                $companyUsers->tin = $company->tin;
                $companyUsers->enabled = 1;
                $companyUsers->status = 1;
                if (!$companyUsers->save()) {
                    $reason = Json::encode($companyUsers->getErrors());
                }
            }
        }






        if($reason==""){
            $users = User::findOne(['username'=>$subjectModel['UID']]);

        }
        if($reason==""){
            Yii::$app->user->login($users, 1800 );
            $session = Yii::$app->session;
            $session->set('company_id',$companyUsers->company_id);
        }

        if($reason==""){
            $dataOnline = Components::CheckOnline(Components::CompanyData('tin'));
            $url_href = "/";
            $dataOnline = Json::decode($dataOnline);
            $is_online = 1;
            if(isset($dataOnline['providers'])) {
                foreach ($dataOnline['providers'] as $items) {
                    if($items['providerTin']=="306717486" && $items['enabled']==false){
                        $url_href = "/site/set-rouming";
                        $is_online = 0;
                    } else {
                        $is_online = 1;
                    }
                }
            }
            $checkCount = Company::findOne(['id'=>Components::GetId()]);
            $checkCount->is_online =$is_online;
            $checkCount->count_login += 1;
            if(!$checkCount->save()){
//                var_dump($checkCount->getErrors());die;
            }
            $result = [
                'success'=>true,
                'url'=>$url_href
            ];
        } else {
            $result = [
                'success'=>false,
                'reason'=>$reason
            ];
        }

        print_r(Json::encode($result));
    }





    protected function getNp1($tin){

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

        $url = "https://my.soliq.uz/services/np1/bytin/factura?lang=uz&tin=".$tin;
        return file_get_contents($url, false, $context);
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
