<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use common\models\Company;
use common\models\CompanyInvoicesHelpers;
use common\models\CompanyTarif;
use common\models\Docs;
use common\models\EmpowermentProduct;
use common\models\Invoices;
use common\models\MonthPay;
use kartik\mpdf\Pdf;
use Yii;
use common\models\Empowerment;
use common\models\EmpowermentSaerch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpowermentController implements the CRUD actions for Empowerment model.
 */
class EmpowermentController extends \cabinet\components\Controller
{
    /**
     * {@inheritdoc}
     */


    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";



    /**
     * Lists all Empowerment models.
     * @return mixed
     */


    public function actionPdf($id){
        $model = $this->findModel($id);
        $products = EmpowermentProduct::find()->andWhere(['company_id'=>Components::GetId(),'empowerment_id'=>$model->id])->orderBy('id ASC')->all();

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


    public function actionIndex()
    {
        $searchModel = new EmpowermentSaerch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId(),'type'=>[Docs::TYPE_IN,Docs::TYPE_IN_AGENT]]);

        $searchModel_send = new EmpowermentSaerch();
        $dataProvider_send = $searchModel_send->search(Yii::$app->request->queryParams);
        $dataProvider_send->query->where('status<>1')->andWhere(['company_id'=>Components::GetId(),'type'=>Docs::TYPE_OUT]);

        $searchModel_saved = new EmpowermentSaerch();
        $dataProvider_saved = $searchModel_send->search(Yii::$app->request->queryParams);
        $dataProvider_saved->query->andWhere(['company_id'=>Components::GetId(),'status'=>Docs::NEW_DATA ,'type'=>Docs::TYPE_OUT]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

            'searchModel_sent' => $searchModel_send,
            'dataProvider_sent' => $dataProvider_send,

            'searchModel_saved' => $searchModel_saved,
            'dataProvider_saved' => $dataProvider_saved,
        ]);
    }

    public function actionIndexSend()
    {
        $searchModel = new EmpowermentSaerch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('status<>1')->andWhere(['company_id'=>Components::GetId(),'type'=>Docs::TYPE_OUT]);

        return $this->render('index-send', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexIn()
    {
        $searchModel = new EmpowermentSaerch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId(),'type'=>[Docs::TYPE_IN,Docs::TYPE_IN_AGENT]]);

        return $this->render('index-in', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexSaved()
    {
        $searchModel = new EmpowermentSaerch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId(),'status'=>Docs::NEW_DATA ,'type'=>Docs::TYPE_OUT]);

        return $this->render('index-saved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Empowerment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
            $model = Empowerment::findOne(['id'=>$facturaId,'company_id'=>Components::GetId()]);
            if(empty($model)){
                $reason="Bunday ishonchnoma topilmadi";
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
                    $invoices->reason = $tarif->name." ga ko'ra №:".$model->EmpowermentId." raqamli ishonchnoma xujjati uchun xisob yechib olindi";
                    $invoices->tarif_id = $model->id;
                    $invoices->status = 1;
                }
            }
        }
        if($reason=="") {
            $result = $this->SendEmpWithCurl($data);
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }
        if($reason==""){
            $model->status = Empowerment::SEND;
            $model->save();
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


    public function actionRejectData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $facturaId = Yii::$app->request->post('facturaId');
        $notes = Yii::$app->request->post('notes');
        $model = Empowerment::findOne(['id'=>$facturaId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }
        if($reason=="") {

            if($model->AgentTin==Yii::$app->user->identity->username){
                $sendData = [
                    "action"=>"reject",
                    'agentEmpowermentId'=>$model->AgentEmpowermentId,
                    'notes'=>$notes,
                    'sign'=>$data,
                    'clientIp'=>Yii::$app->request->getUserIP()
                ];
                $result = $this->AcceptEmpWithCurl($sendData, "/agent/empowerment");
//                echo "EROR:".$result;die;
            } else{
                $sendData = [
                    "action"=>"reject",
                    'empowermentId'=>$model->EmpowermentId,
                    'notes'=>$notes,
                    'sign'=>$data,
                    'clientIp'=>Yii::$app->request->getUserIP()
                ];
                $result = $this->AcceptEmpWithCurl($sendData, "/empowerments/seller");
            }

//            echo $result;die;
            $result = Json::decode($result);

            $reason = (isset($result['errorMessage'])) ? $result['errorMessage']." - ".$model->EmpowermentId : '';
        }

        if($reason==""){
            $model->status = Docs::AGENT_REJECTED;
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


    public function actionAcceptData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $facturaId = Yii::$app->request->post('facturaId');
        $model = Empowerment::findOne(['id'=>$facturaId]);
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

            if($model->AgentTin==Yii::$app->user->identity->username){
                $sendData = [
                    "action"=>"accept",
                    'agentEmpowermentId'=>$model->AgentEmpowermentId,
                    'sign'=>$data,
                    'clientIp'=>Yii::$app->request->getUserIP()
                ];
                $result = $this->AcceptEmpWithCurl($sendData, "/agent/empowerment");
            } else{
                $sendData = [
                    "action"=>"accept",
                    'empowermentId'=>$model->EmpowermentId,
                    'sign'=>$data,
                    'clientIp'=>Yii::$app->request->getUserIP()
                ];
                $result = $this->AcceptEmpWithCurl($sendData, "/empowerments/seller");
            }

//            echo $result;die;
            $result = Json::decode($result);
//            var_dump($result);die;
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage']." - ".$model->EmpowermentId : '';
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

    public function actionCanceledData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $empId = Yii::$app->request->post('facturaId');
        $model = Empowerment::findOne(['id'=>$empId]);
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
            $sendData = [
                'empowermentId'=>$model->EmpowermentId,
                'sign'=>$data,
                'clientIp'=>Yii::$app->request->getUserIP()
            ];
            $result = $this->AcceptEmpWithCurl($sendData,"/empowerments/buyer/cancel");
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

    protected function AcceptEmpWithCurl($sendData,$url){
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/ru/".Components::CompanyData('tin').$url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERPWD, self::LOGIN . ":" . self::PASSWORD);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, Json::encode($sendData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
//        if (!curl_errno($ch)) {
//            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
//                case 200:  # OK
//                    break;
//                default:
//                    echo 'Неожиданный код HTTP: ', $http_code, "\n";die;
//            }
//        }

        curl_close($ch);

        return $return;
    }

    public function actionGetBuyerSign($id){
        $emp = Empowerment::findOne(['id'=>$id]);
        $reason="";
        if(empty($emp))
            $reason = "Factura mavjud emas";
        if($reason=="") {

            $url = "/empowerments/buyer/signedfile/".$emp->EmpowermentId;
            $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/ru/".$emp->BuyerTin.$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERPWD, self::LOGIN . ":" . self::PASSWORD);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($ch);
            curl_close($ch);

        }

        if($reason==""){
            $result = [
                'success'=>true,
                'data'=>$return
            ];
        } else {
            $result = [
                'success'=>false,
                'data'=>"Kutilmagan xatolik"
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }
    /**
     * Creates a new Empowerment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empowerment();
        $companydData = Company::findOne(['id'=>Components::GetId()]);
        $accountant_num = "";
        $mfo = "";
        $acountant = CompanyInvoicesHelpers::findOne(['company_id'=>Components::GetId()]);
        if(!empty($acountant)){
            $accountant_num = $acountant->invoices_number;
            $mfo = $acountant->mfo;
        }
//        echo $mfo;die;
        $model->enabled = 1;
        $model->company_id = Components::GetId();
        $model->type = Empowerment::TYPE_OUT;
        $model->status = Empowerment::NEW_DATA;
        $model->BuyerTin = (string)$companydData->tin;
        $model->BuyerName = $companydData->name;
        $model->BuyerAccount = $accountant_num;
        $model->BuyerBankId = (string)$mfo;
        $model->BuyerAddress = $companydData->address;
        $model->BuyerOked = $companydData->oked;
        $model->BuyerWorkPhone = $companydData->phone;
        $model->BuyerDirector = $companydData->director;
        $model->BuyerAccountant = $companydData->accountant;
        $model->BuyerDistrictId = sprintf("%02d",$companydData->ns10_code).sprintf("%02d",$companydData->ns11_code);
        $model->EmpowermentId = $this->getId();
        $model->EmpowermentProductId = $this->getId();
        $model->AgentEmpowermentId = $this->getId();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $itemsData = Json::decode($model->items_json);
            $k=0;
            foreach ($itemsData as $items){
                $k++;
                $data = new EmpowermentProduct();
                $data->company_id = Components::GetId();
                $data->empowerment_id = $model->id;
                $data->Name = $items['ProductName'];
                $data->MeasureId = $items['ProductMeasureId'];
                $data->Count =$items['ProductCount'];
                $data->enabled = 1;
                if(!$data->save()){
                    Yii::$app->session->setFlash('danger', Json::encode($data->getErrors()));
                    return $this->render('update', [
                        'model' => $model,
                        'error'=>Json::encode($data->getErrors())
                    ]);
                }
            }


            return $this->redirect(['view', 'id' => $model->id]);
        }
        $error = "";
        if($model->getErrors()){
            foreach ($model->getErrors() as $key=>$value){
                $error .= $value[0]." ";
            }
        }

        return $this->render('create', [
            'model' => $model,
            'error'=>$error
        ]);
    }

    /**
     * Updates an existing Empowerment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $error="";
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $itemsData = Json::decode($model->items_json);
            $k = 0;
            EmpowermentProduct::deleteAll(['company_id' => Components::GetId(), 'empowerment_id' => $model->id]);
            foreach ($itemsData as $items) {
                $k++;
                $data = new EmpowermentProduct();
                $data->company_id = Components::GetId();
                $data->empowerment_id = $model->id;
                $data->Name = $items['ProductName'];
                $data->MeasureId= $items['ProductMeasureId'];
                $data->Count=$items['ProductCount'];
                $data->enabled = 1;

                if (!$data->save()) {

                    if($model->getErrors()){
                        foreach ($model->getErrors() as $key=>$value){
                            $error .= $value[0]." ";
                        }
                    }
                    return $this->render('update', [
                        'model' => $model,
                        'error'=>$error
                    ]);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'error'=>$error
        ]);
    }

    /**
     * Deletes an existing Empowerment model.
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
     * Finds the Empowerment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empowerment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empowerment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function SendEmpWithCurl($data){
        $sendData = [
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/empowerments/buyer");
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
}
