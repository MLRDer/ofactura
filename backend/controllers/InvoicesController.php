<?php

namespace backend\controllers;

use cabinet\models\Components;
use common\models\BankInvoicesLog;
use Yii;
use common\models\Invoices;
use common\models\InvoicesItemsSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * InvoicesController implements the CRUD actions for Invoices model.
 */
class InvoicesController extends \common\components\Controller
{

    public function actionIndex()
    {    
        $searchModel = new InvoicesItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function behaviors(){
        return [
            [
                'class' => AccessControl::class,
                'only' => ['get-all-invoicess'],
                'rules'=>[
                    [
                        'actions' => ['get-all-invoicess'],
                        'allow' => true,
                        'roles' => ['?'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionGetAllInvoicess(){

        header("Access-Control-Allow-Origin: *");
        Yii::$app->controller->enableCsrfValidation = false;

        if($_GET['auth_token']=="A314xWlsp92819kldK"){
            if (isset($_GET['start_date']) && isset($_GET['end_date'])){

                $start_date = $_GET['start_date'];
                $end_date = $_GET['end_date'];

                $invoices = Invoices::find()->where(' created_date between '.$start_date.' and ' . $end_date.' ')->all();



                return json_encode(['success'=>true, 'data'=>$invoices]);
            }
            return json_encode(['success'=>false, 'data'=>"filter dates are not set"]);
        }

        return json_encode(['success'=>false, 'data'=>"status: 401"]);
    }


    public function actionReload(){
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
        Yii::$app->response->format = Response::FORMAT_JSON;
//        echo $result;die;
        $model = Json::decode($result);
        $all_sum = 0;
        $key="---";
        if(isset($model['data'])){
            foreach ($model['data'] as $items){
                $checkLog = BankInvoicesLog::findOne(['id'=>$items['id']]);
                if(empty($checkLog)) {
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
                    $key_rekvizit=["00668","00599"];
                    if (in_array($key,$key_rekvizit) && $data->type==1) {
                        $check = Invoices::findOne(['bank_data_id' => $items['id']]);
                        if (empty($check)) {
                            $all_sum = $all_sum +  $items['sumPay'] / 100;
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
                }
            }
        }
        $result_messages = '<div class="alert alert-warning" role="alert">Xisob qayd qilinmagan</div>';
        if($all_sum>0)
            $result_messages = '<div class="alert alert-success" role="alert">Jami <b> '.$all_sum.' </b> - so`mlik xisob qayd qilingan. <a href="/bank-invoices">Batafsil bu yerda</a></div>';

        return [
            'title'=> "Bank reload - ".$key,
            'forceReload'=>'#crud-datatable-pjax',
            'content'=>$result_messages,
            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
        ];
    }

    /**
     * Displays a single Invoices model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Invoices #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Invoices model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $request = Yii::$app->request;
        $model = new Invoices();
        $model->company_id = $id;
        $model->tin = Yii::$app->request->get('tin');
        $model->created_date  =date('Y-m-d H:i');
        $model->type_invoices = 1;
        $model->type_pay = 3;
//        $model->reason = "Tizim orqali suniy xisob toldirish amalga oshirildi ADMIN:".Yii::$app->user->id;
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Invoices",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Invoices",
                    'content'=>'<span class="text-success">Create Invoices success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new Invoices",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Invoices model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Invoices #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Invoices #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Invoices #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Invoices model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Invoices model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Invoices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
