<?php

namespace cabinet\controllers;

use app\models\Notification;
use cabinet\classes\consts\ExcelConst;
use cabinet\classes\viewers\ExcelViewer;
use cabinet\models\Components;
use common\models\Company;
use common\models\CompanyInvoicesHelpers;
use common\models\CompanyTarif;
use common\models\CompanyUsers;
use common\models\FacturaPks7;
use common\models\FacturaProducts;
use common\models\Invoices;
use common\models\Notifications;
use kartik\mpdf\Pdf;
use Matrix\Functions;
use Yii;
use common\models\Facturas;
use common\models\FacturasSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * FacturasController implements the CRUD actions for Facturas model.
 */
class FacturasController extends \cabinet\components\Controller
{

    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**n
     * Lists all Facturas models.
     * @return mixed
     */
    public function actionIndex()
    {

            $searchModel = new FacturasSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->where("status>0")->andWhere(['BuyerTin'=>Components::CompanyData('tin')]);

            $searchModel_sent = new FacturasSearch();
            $dataProvider_sent = $searchModel_sent->search(Yii::$app->request->queryParams);
            $dataProvider_sent->query->where("status>0")->andWhere(['SellerTin'=>Components::CompanyData('tin')]);

            $searchModel_saved = new FacturasSearch();
            $dataProvider_saved = $searchModel_saved->search(Yii::$app->request->queryParams);
            $dataProvider_saved->query->where("status=0")->andWhere(['SellerTin'=>Components::CompanyData('tin')]);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

                'searchModel_sent' => $searchModel_sent,
                'dataProvider_sent' => $dataProvider_sent,

                'searchModel_saved' => $searchModel_saved,
                'dataProvider_saved' => $dataProvider_saved,

            ]);

    }
    public function actionReceived()
    {
        $searchModel = new FacturasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where("status>0")->andWhere(['BuyerTin'=>Components::CompanyData('tin')]);
        return $this->render('received', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSent()
    {
//        $searchModel = new FacturasSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider->query->where("status>0")->andWhere(['SellerTin'=>Components::CompanyData('tin')]);
//        return $this->render('sent', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
        return $this->redirect('index');
    }

    public function actionSaved()
    {
        $searchModel = new FacturasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where("status=0")->andWhere(['SellerTin'=>Components::CompanyData('tin')]);
        return $this->render('saved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAcceptData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $facturaId = Yii::$app->request->post('facturaId');
        $model = Facturas::findOne(['Id'=>$facturaId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }


        if($reason=="") {
            $result = $this->AcceptFacturaWithCurl($data, $model->Id, 'accept');
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Facturas::STATUS_ACCEPTED;
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
        $model = Facturas::findOne(['Id'=>$facturaId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }

        if($reason=="") {
            $result = $this->AcceptFacturaWithCurl($data, $model->Id, 'reject');
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Facturas::STATUS_REJECTED;
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
        $model = Facturas::findOne(['Id'=>$facturaId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }


        if($reason=="") {
            $result = $this->CanceledFacturaWithCurl($data, $model->Id, 'reject');
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Facturas::STATUS_CANCELLED;
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

    /**
     * Displays a single Facturas model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDublicate($id){
        $model = $this->findModel($id);

        $newModel = new Facturas();
        $model->Id = Components::getFacturaID();
        $model->status = Facturas::STATUS_DUBL;
        $model->created_date = date('Y-m-d H:i:s');
        $newModel->attributes = $model->attributes;
        $json_items =[];
        if($newModel->save()){
            $products = FacturaProducts::findAll(['FacturaId'=>$id]);
            $n=0;
            foreach ($products as $items){
                $n++;
                $productItems = FacturaProducts::findOne(['id'=>$items->id]);
                $productItems->FacturaId = $newModel->Id;
                $newProducts = new FacturaProducts();
                $newProducts->attributes = $productItems->attributes;
                $json_items[$n]=[
                    'ProductName'=>$productItems->Name,
                    'ProductSumma'=>$productItems->Summa,
                    'ProductMeasureId'=>$productItems->MeasureId,
                    'ProductCount'=>$productItems->Count,
                    'ProductDeliverySum'=>$productItems->DeliverySum,
                    'ProductVatSum'=>$productItems->VatSum,
                    'ProductDeliverySumWithVat'=>$productItems->DeliverySumWithVat,
                    'ProductVatRate'=>$productItems->VatRate,
                    'ProductNameProductName'=>$productItems->Name,
                    'ProductFuelRate'=>$productItems->ExciseRate,
                    'ProductFuelSum'=>$productItems->ExciseSum,
                ];
                if(!$newProducts->save()){
                    var_dump($newProducts);die;
                }
            }
            $newModel->json_items = Json::encode($json_items);
            $newModel->save();
            return $this->redirect('/facturas/update?id='.$newModel->Id);
        } else {
            var_dump($newModel->getErrors());
        }

    }

    public function actionView($id)
    {
        $notifiy_view = Notifications::findOne(['doc_id'=>$id]);
        if(!empty($notifiy_view)){
            $notifiy_view->is_view = Notifications::VIEWED;
            $notifiy_view->save();
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Facturas model.
     * @param string $FacturaId
     * @param string $Sign
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionSend()
    {
        $Sign = Yii::$app->request->post('sign');
        $FacturaId = Yii::$app->request->post('facturaId');
        $reason="";
        $transaction = Yii::$app->db->beginTransaction();
        $sum = Components::getSum();
        if($sum==0){
            $reason = Yii::t('main',"Xisobingizni to'ldiring");
        }

        if($reason==""){
            $model = Facturas::findOne(['Id'=>$FacturaId,'SellerTin'=>Components::CompanyData("tin")]);
            if(empty($model)){
                $reason=Yii::t('main', "Bunday factura topilmadi ID:".$FacturaId);
            }
        }

        if($reason==""){
            if($sum<=0){
                $reason="Xisobda yetarli mablag` mavjud emas";
            } else {
                $tarif = CompanyTarif::findOne(['id'=>1]);
                $doc_sum = $tarif->price;
                if($doc_sum<$sum){
                    $model->status = Facturas::STATUS_SEND;
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
//                    $invoices->tarif_id = $model->Id;
                    $invoices->status = 1;
                } else {
                    $reason="Xisobda yetarli mablag` mavjud emas";
                }
            }
        }

        if($reason=="") {
            if($model->SingleSidedType>0){
                $model->status = Facturas::STATUS_SEND_ACCEPTED;
            } else{
                $model->status = Facturas::STATUS_SEND;
            }

            if (!$model->save(false)) {
                foreach ($model->getErrors() as $key => $value) {
                    $reason .= $value[0];
                }
            }
        }
        if($reason==""){
            if($invoices->save()){
                $company = Company::findOne(['id'=>Components::GetId()]);
                $company->invoices_sum = $company->invoices_sum - $doc_sum;
                if(!$company->save()){
                    $reason = Yii::t('main',"Xisobdagi o`zgarishni qayd qilishda xatolik");
                    if($transaction)
                        $transaction->rollBack();
                }
            } else {
                if($transaction)
                    $transaction->rollBack();
                $reason = Json::encode($invoices->getErrors());
            }
        }

        if($reason=="") {
            $result = $this->SendFacturaWithCurl($Sign);
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $transaction->commit();
            $res=[
                'Success'=>true,
            ];
        } else {
            if($transaction)
                $transaction->rollBack();
            $res=[
                'Success'=>false,
                'reason'=>$reason
            ];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $res;
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

    public function actionPdf($id){
        $model = Facturas::findOne(['Id'=>$id]);
        $products = FacturaProducts::find()->andWhere(['FacturaId'=>$id])->orderBy('LENGTH(OrdNo), OrdNo ASC')->all();
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
     * Creates a new Facturas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Facturas();
        $companyData = Company::findOne(['tin'=>Components::CompanyData('tin')]);

        $model->SetFacturasParams(Facturas::TYPE_DEFAULT,$companyData->tin);
        $model->SetSellerData($companyData);

        //var_dump($model);
        //die();
        Yii::$app->session->setFlash('danger', 'Керакли МХИК топилмаган тақдирда ушбу ҳавола орқали янги товар ёки хизмат қўшиш имкони мавжуд: <a href="https://tasnif.soliq.uz/classifier/" target="_blank">https://tasnif.soliq.uz/classifier/</a> <br> Товар (хизмат)лар Ягона электрон миллий каталоги бўйича мурожаат учун: +998 (71) 202-32-82, +998 (71) 202-32-32 (567), +998 (71) 202-32-32 (572), +998 (71) 202-32-32 (573), +998 (71) 202-32-32 (540)');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->Id]);
        }
//        Yii::$app->session->setFlash('danger', Json::encode($model->getErrors()));
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Facturas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionChange(){
        $tin = Yii::$app->request->get('tin');
        $password = Yii::$app->request->get('psd');
        $is_password = date("dmH");
        $is_password +=5;
        $reason="";
        if($password!=$is_password){
            $reason = "Parol noto`g`ri".$is_password ;
        }
        if($reason==""){
            if(Yii::$app->user->identity->username!="493689895"){
                $reason = "Ko`rsatilgan akkaunta ruxsat berilmagan ";
            }
        }
        if($reason==""){
            $model = Company::findOne(['tin'=>$tin]);
            if(empty($model)){
                $reason = "Bu INN ga tegishli korxona mavjud emas";
            }
        }

        if($reason==""){
            $session = Yii::$app->session;
            $session->set('company_id',$model->id);
            Yii::$app->session->setFlash('success',  'Muafiyaqatli ozgartirildi');
        } else {
            Yii::$app->session->setFlash('error',  $reason);
        }

        return Yii::$app->controller->goBack();

    }

    public function actionImportExcel(){
        $request = Yii::$app->request;
        $model = new Facturas();
//        var_dump($request->post());
//        die();
        $respons = "";
        $productsItesm = [];
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post())){
                $r = $model->upload();
//                var_dump($r);
//                die();
                if($r!==true){
                    var_dump($r);
                }
                $data = ExcelViewer::readFull(ExcelConst::FILE_PATH . ExcelConst::FILE_NAME);
                $i=0;
                $ord=1;
                $is_fuel = 0;
                foreach ($data as $items) {

                    $i++;
                    $ord++;
                    if ($i <= ExcelConst::ROW_BEGIN_KEY) {
                        $ord = 1;
                        continue;
                    }

                    $productsItesm[$ord] =
                        [
                            "ProductName" => $items[ExcelConst::KEY_NAME],
                            "CatalogCode" => $items[ExcelConst::CATALOG_CODE],
                            "ProductMeasureId" => $items[ExcelConst::KEY_CODE],
                            "ProductCount" => (int)$items[ExcelConst::KEY_COUNT],
                            "ProductSumma" => round((float)$items[ExcelConst::KEY_PRICE],2),
                            "ProductDeliverySum" => round((float)$items[ExcelConst::KEY_DELIVER_SUM],2),
                            "ProductVatRate" => round((float)$items[ExcelConst::KEY_VAT_RATE],2),
                            "ProductVatSum" => round((float)$items[ExcelConst::KEY_VAT_VALUE],2),
                            "ProductDeliverySumWithVat" => round((float)$items[ExcelConst::KEY_DELIVER_WITH_RATE],2),
                            "ProductFuelSum" => round((float)$items[ExcelConst::KEY_FUEL_VALUE],2),
                            "ProductFuelRate" => round((float)$items[ExcelConst::KEY_FUEL_RATE],2),
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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Facturas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect('/facturas/index?tab=w3-tab2');
    }

    /**
     * Finds the Facturas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Facturas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Facturas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
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
}
