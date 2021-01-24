<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use common\models\ActProducts;
use common\models\Company;
use common\models\CompanyTarif;
use common\models\FacturaProducts;
use common\models\Facturas;
use common\models\FormatNo;
use common\models\Invoices;
use kartik\mpdf\Pdf;
use Yii;
use common\models\Acts;
use common\models\ActsSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActController implements the CRUD actions for Acts model.
 */
class ActController extends \common\components\Controller
{
    /**
     * {@inheritdoc}
     */


    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";
    /**
     * Lists all Acts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where("status>0")->andWhere(['BuyerTin'=>Components::CompanyData('tin')]);

        $searchModel_sent = new ActsSearch();
        $dataProvider_sent = $searchModel_sent->search(Yii::$app->request->queryParams);
        $dataProvider_sent->query->where("status>0")->andWhere(['SellerTin'=>Components::CompanyData('tin')]);

        $searchModel_saved = new ActsSearch();
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

    public function actionAcceptData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $actId = Yii::$app->request->post('actId');
        $model = Acts::findOne(['Id'=>$actId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }


        if($reason=="") {
            $result = $this->AcceptActWithCurl($data, $model->Id, 'accept');
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
        $notes = Yii::$app->request->post('notes');
        $actId = Yii::$app->request->post('actId');
        $model = Acts::findOne(['Id'=>$actId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }

        if($reason=="") {
            $result = $this->AcceptActWithCurl($data, $model->Id, 'reject',$notes);
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->notes = $notes;
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

    protected function AcceptActWithCurl($data,$actId,$action,$notes=null){
        $sendData = [
            "action"=>$action,
            'actId'=>$actId,
            'notes'=>$notes,
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/acts/buyer");
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

    /**
     * Displays a single Acts model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPdf($id){
        $model = Acts::findOne(['Id'=>$id]);

        $products = ActProducts::find()->andWhere(['act_id'=>$id])->orderBy('LENGTH(OrdNo), OrdNo ASC')->all();
        $content = $this->renderPartial('_pdf',['model'=>$model,'products' =>$products]);
        $type = Yii::$app->request->get('type',1);
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => ($type==0)?Pdf::ORIENT_LANDSCAPE:Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@cabinet/web/css/pdf.css',
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


    public function actionSend()
    {
        $Sign = Yii::$app->request->post('sign');
        $act_id = Yii::$app->request->post('actId');
        $reason="";
        $transaction = Yii::$app->db->beginTransaction();
        $sum = Components::getSum();
        if($sum==0){
            $reason = Yii::t('main',"Xisobingizni to'ldiring");
        }

        if($reason==""){
            $model = Acts::findOne(['Id'=>$act_id,'SellerTin'=>Components::CompanyData("tin")]);
            if(empty($model)){
                $reason=Yii::t('main', "Bunday akt topilmadi ID:".$act_id);
            }
        }

        if($reason==""){
            if($sum<=0){
                $reason="Xisobda yetarli mablag` mavjud emas";
            } else {
                $tarif = CompanyTarif::findOne(['id'=>1]);
                $doc_sum = $tarif->price;
                if($doc_sum<$sum){
                    $model->status = Acts::STATUS_SEND;
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
                    $invoices->reason = $tarif->name." ga ko'ra №:".$model->ActNo." raqamli akt xujjati uchun xisob yechib olindi";
//                    $invoices->tarif_id = $model->Id;
                    $invoices->status = 1;
                } else {
                    $reason="Xisobda yetarli mablag` mavjud emas";
                }
            }
        }

        if($reason=="") {
            $model->status = Facturas::STATUS_SEND;
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
            $result = $this->SendActWithCurl($Sign);
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

    public function actionCanceledData()
    {
        $reason="";
        $data = Yii::$app->request->post('sign');
        $actId = Yii::$app->request->post('actId');
        $model = Acts::findOne(['Id'=>$actId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }


        if($reason=="") {
            $result = $this->CanceledActWithCurl($data, $model->Id, 'reject');
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Acts::STATUS_CANCELLED;
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

    protected function CanceledActWithCurl($data,$act_id,$action){
        $sendData = [
            'ActId'=>$act_id,
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/acts/seller/cancel");
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

    protected function SendActWithCurl($data){
        $sendData = [
            'sign'=>$data, 
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/acts/seller");
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

    /**
     * Creates a new Acts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Acts();
        $model->ActText = 'Биз қуйида имзо чекувчилар, 4-SON QURILISH TRESTI бир томондан, бундан кейин Пудратчи деб номланади ва _____________________________________________, иккинчи томондан, бундан кейин Буюртмачи деб номланади, Буюртмачининг талабларига мувофиқ иш тўлиқ бажарилганлиги тўғрисида далолатнома туздик.';
        $model->SellerTin = Components::CompanyData('tin');
        $model->SellerName = Components::CompanyData('name');
        $model->Id = Components::getFacturaID();
        $model->ActProductId = Components::getFacturaID();
        $model->status = Acts::STATUS_NEW;
        $model->created_date = date('Y-m-d H:i:s');
        $model->Tin = (string)$model->SellerTin;
        $model->type = Acts::TYPE_MANUAL;
        $model->ActNo = FormatNo::GetNextNumeric(FormatNo::TYPE_ACT);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            FormatNo::SetNextNumeric(FormatNo::TYPE_ACT);
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Acts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
     * Deletes an existing Acts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Acts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Acts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }
}
