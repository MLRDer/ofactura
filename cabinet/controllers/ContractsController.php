<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use common\models\ActProducts;
use common\models\Acts;
use common\models\Company;
use common\models\CompanyTarif;
use common\models\ContractClients;
use common\models\ContractParts;
use common\models\ContractProducts;
use common\models\Facturas;
use common\models\FormatNo;
use common\models\Invoices;
use kartik\mpdf\Pdf;
use Yii;
use common\models\Contracts;
use common\models\ContractsSearch;


use yii\base\Model;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ContractsController implements the CRUD actions for Contracts model.
 */
class ContractsController extends \cabinet\components\Controller
{

    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";

    /**
     * Lists all Contracts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('c.status>0')->andWhere(["cc.Tin"=>Components::CompanyData('tin')]);

        $searchModel_sent = new ContractsSearch();
        $dataProvider_sent = $searchModel_sent->search(Yii::$app->request->queryParams);
        $dataProvider_sent->query->where('c.status>0')->andWhere(["c.Tin"=>Components::CompanyData('tin')]);

        $searchModel_saved = new ContractsSearch();
        $dataProvider_saved = $searchModel_saved->search(Yii::$app->request->queryParams);
        $dataProvider_saved->query->where('c.status=0')->andWhere(["c.Tin"=>Components::CompanyData('tin')]);
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
        $contractId = Yii::$app->request->post('contractId');
        $model = Contracts::findOne(['Id'=>$contractId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }


        if($reason=="") {
            $result = $this->AcceptContractWithCurl($data, $model->Id, 'accept');
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->status = Contracts::STATUS_ACCEPTED;
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
        $actId = Yii::$app->request->post('contractId');
        $model = Contracts::findOne(['Id'=>$actId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }

        if($reason=="") {
            $result = $this->AcceptContractWithCurl($data, $model->Id, 'reject',$notes);
            $result = Json::decode($result);
            $reason = (isset($result['errorMessage'])) ? $result['errorMessage'] : '';
        }

        if($reason==""){
            $model->notes = $notes;
            $model->status = Contracts::STATUS_REJECTED;
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
        $actId = Yii::$app->request->post('contractId');
        $model = Contracts::findOne(['Id'=>$actId]);
        if(empty($model)) {
            $reason = "Bunday factura mavjud emas";
        }


        if($reason=="") {
            $result = $this->CanceledContractWithCurl($data, $model->Id, 'reject');
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

    protected function CanceledContractWithCurl($data,$contract_id,$action){
        $sendData = [
            'ContractId'=>$contract_id,
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/contracts/owner/cancel");
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

    protected function AcceptContractWithCurl($data,$actId,$action,$notes=null){
        $sendData = [
            "action"=>$action,
            'contractId'=>$actId,
            'notes'=>$notes,
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/contracts/client");
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
     * Displays a single Contracts model.
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

    /**
     * Creates a new Contracts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contracts();
        $model->SetOwner();
        $model->ContractNo = FormatNo::GetNextNumeric(FormatNo::TYPE_CONTRACT);
        $modelClients = [new ContractClients()];
        $modelParts = [];
        $currentParts = [
            Yii::t('main','Товар (хизмат)ларнинг тўлиқ тафсилоти:'),
            Yii::t('main','Муҳим шартлар:'),
            Yii::t('main','Тўлов тартиби, мажбуриятларни бажариш шартлари ва муддати'),
            Yii::t('main','Тўлов тартиби, мажбуриятларни бажариш шартлари ва муддати'),
            Yii::t('main','Томонларнинг ҳуқуқ ва мажбуриятлари'),
            Yii::t('main','Томонларнинг жавобгарлиги'),
            Yii::t('main','Низоларни бартараф қилиш тартиби'),
            Yii::t('main','Товар (хизмат)ларни қабул қилиш топшириш тартиби)'),
            Yii::t('main','Шартномани ўзгартириш ва тугатиш тартиби'),
            Yii::t('main','ФОРС-МАЖОР'),
            Yii::t('main','Бошқа шартлар'),
        ];
        foreach ($currentParts as $title_items){
            $data = new ContractParts();
            $data->Title = $title_items;
            $modelParts[]=$data;
        }
//        $modelClients->contract_id = $model->Id;
        if ($model->load(Yii::$app->request->post())) {
            $modelClients = \cabinet\models\Model::createMultiple(ContractClients::className());
            $modelParts = \cabinet\models\Model::createMultiple(ContractParts::className());
            Model::loadMultiple($modelClients, Yii::$app->request->post());
            Model::loadMultiple($modelParts, Yii::$app->request->post());
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelClients) && $valid;
            $valid = Model::validateMultiple($modelParts) && $valid;
//            var_dump($model->getErrors());die;
            if($valid){

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save()) {
                        foreach ($modelClients as $modClient) {
                            $modClient->contract_id = $model->Id;
                            if (! ($flag = $modClient->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $n=0;
                        foreach ($modelParts as $modParts) {
                            $n++;
                            $modParts->OrdNo = $n;
                            $modParts->contract_id = $model->Id;
                            if (! ($flag = $modParts->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        FormatNo::SetNextNumeric(FormatNo::TYPE_CONTRACT);
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->Id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
//                    var_dump($model->getErrors());
//                    var_dump($modelClients->getErrors());die;
                }
            } else{
//                var_dump($valid);die;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsClients'=>(empty($modelClients))?[new ContractClients()]:$modelClients,
            'modelsParts'=>(empty($modelParts))?[new ContractParts()]:$modelParts,
        ]);
    }


    /**
     * Updates an existing Contracts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelClients = ContractClients::findAll(['contract_id'=>$model->Id]);
        $modelParts = ContractParts::findAll(['contract_id'=>$model->Id]);
        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelClients, 'id', 'id');
            $oldPartsIDs = ArrayHelper::map($modelParts, 'id', 'id');
            $modelClients = \cabinet\models\Model::createMultiple(ContractClients::classname(), $modelClients);
            $modelParts = \cabinet\models\Model::createMultiple(ContractParts::className(),$modelParts);
            Model::loadMultiple($modelClients, Yii::$app->request->post());
            Model::loadMultiple($modelParts, Yii::$app->request->post());
//            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelClients, 'id', 'id')));
//            $deletedPartsIDs = array_diff($oldPartsIDs, array_filter(ArrayHelper::map($modelParts, 'id', 'id')));




            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelClients) && $valid;
            $valid = Model::validateMultiple($modelParts) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        ContractClients::deleteAll(['contract_id' => $model->Id]);
                        ContractParts::deleteAll(['contract_id' => $model->Id]);
                        foreach ($modelClients as $modelClnt) {
                            $modelClnt->contract_id = $model->Id;
                            if (! ($flag = $modelClnt->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $n=0;
                        foreach ($modelParts as $modParts) {
                            $n++;
                            $modParts->OrdNo = $n;
                            $modParts->contract_id = $model->Id;
                            if (! ($flag = $modParts->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->Id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsClients'=>(empty($modelClients))?[new ContractClients()]:$modelClients,
            'modelsParts'=>(empty($modelParts))?[new ContractParts()]:$modelParts,
        ]);
    }



    public function actionPdf($id){
        $model = Contracts::findOne(['Id'=>$id]);

        $products = ContractProducts::find()->andWhere(['contract_id'=>$id])->orderBy('LENGTH(OrdNo), OrdNo ASC')->all();
        $content = $this->renderPartial('_pdf',['model'=>$model,'products' =>$products]);
        $type = Yii::$app->request->get('type',null);
        if($type==null)
            $type=1;
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
        $act_id = Yii::$app->request->post('contractId');
        $reason="";
        $transaction = Yii::$app->db->beginTransaction();
        $sum = Components::getSum();
        if($sum==0){
            $reason = Yii::t('main',"Xisobingizni to'ldiring");
        }

        if($reason==""){
            $model = Contracts::findOne(['Id'=>$act_id,'Tin'=>Components::CompanyData("tin")]);
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
                    $model->status = Contracts::STATUS_SEND;
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
                    $invoices->reason = $tarif->name." ga ko'ra №:".$model->ContractNo." raqamli shartnoma xujjati uchun xisob yechib olindi";
//                    $invoices->tarif_id = $model->Id;
                    $invoices->status = 1;
                } else {
                    $reason="Xisobda yetarli mablag` mavjud emas";
                }
            }
        }

        if($reason=="") {
            $model->status = Contracts::STATUS_SEND;
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

    protected function SendActWithCurl($data){
        $sendData = [
            'sign'=>$data,
            'clientIp'=>Yii::$app->request->getUserIP()
        ];
        $ch = curl_init(Yii::$app->params['factura_host']."/provider/api/uz/".Components::CompanyData('tin')."/contracts/owner");
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
     * Deletes an existing Contracts model.
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
     * Finds the Contracts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Contracts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contracts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }
}
