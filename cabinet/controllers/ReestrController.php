<?php

namespace cabinet\controllers;

use cabinet\classes\consts\ReestrConst;
use cabinet\classes\viewers\ExcelViewer;
use cabinet\models\Components;
use common\models\Company;
use common\models\DocProducts;
use common\models\Docs;
use common\models\DocsSearch;
use common\models\FacturaProducts;
use common\models\Facturas;
use common\models\FacturasSearch;
use Yii;
use common\models\ReestrMain;
use common\models\ReestrMainSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ReestrController implements the CRUD actions for ReestrMain model.
 */
class ReestrController extends \cabinet\components\Controller
{
    /**
     * {@inheritdoc}
     */



//    const HOST = "https://facturatest.yt.uz";
    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";


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

    /**
     * Lists all ReestrMain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReestrMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId()]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionImportReestr(){
        $request = Yii::$app->request;
        $model = new ReestrMain();
        $respons = "";
        $html = "";
        $productsItesm = [];
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->load($request->post())){
                $r = $model->upload();
                if($r!==true){
                    var_dump($r);
                }
                $data = ExcelViewer::readFull(ReestrConst::FILE_PATH . ReestrConst::FILE_NAME);
                $i=0;
                $ord=0;
//                var_dump($data);die;
                foreach ($data as $items) {
                    $i++;
                    $ord++;
                    if ($i <= ReestrConst::ROW_BEGIN_KEY) {
                        $ord = 0;
                        continue;
                    }

                    $productsItesm[] =
                        [
                            "Tin" => $items[ReestrConst::KEY_TIN],
                            "FacNo" => $items[ReestrConst::KEY_FAC_NO],
                            "FacDate" => $items[ReestrConst::KEY_FAC_DATE],
                            "ContNo" => $items[ReestrConst::KEY_CONT_NO],
                            "ContDate" => $items[ReestrConst::KEY_CONT_DATE],

                            "ProductName" => $items[ReestrConst::KEY_NAME],
                            "ProductMeasureId" => $items[ReestrConst::KEY_CODE],
                            "ProductCount" => (int)$items[ReestrConst::KEY_COUNT],
                            "ProductSumma" => round((float)$items[ReestrConst::KEY_PRICE],2),
                            "ProductDeliverSum" => round((float)$items[ReestrConst::KEY_DELIVERY_PRICE],2),
                            "ProductVatRate" => round((float)$items[ReestrConst::KEY_VAT_RATE],2),
                            "ProductVatSum" => round((float)$items[ReestrConst::KEY_VAT_VALUE],2),
                            "ProductDeliverySumWithVat" => round((float)$items[ReestrConst::KEY_DELIVERY_WITH_VAT],2),

                            "ProductFuelRate" => round((float)$items[ReestrConst::KEY_FUEL_RATE],2),
                            "ProductFuelSum" => round((float)$items[ReestrConst::KEY_FUEL_VALUE],2),
                            "ProductDeliverySumWithFuel" => round((float)$items[ReestrConst::KEY_DELIVERY_WITH_FUEL],2),
                        ];
                }
                $html = $this->renderPartial('_reestr',['data'=>$data]);
            } else {
                $respons = "Malumotlar qabul qilinmadi";
            }
        }

        if($respons==""){
            $result = [
                'success'=>true,
                'html'=>$html,
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


    /**
     * Displays a single ReestrMain model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new FacturasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['SellerTin'=>Components::CompanyData('tin'),'reestr_id'=>$id]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ReestrMain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        echo $this->getId();die;
        $model = new ReestrMain();
        $model->company_id = Components::GetId();
        $model->created_date = date('Y-m-d H:i');
        $model->created_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $reason="";
            $data = Json::decode($model->json_data);
            $company = Company::findOne(['id'=>Components::GetId()]);
            foreach ($data as $items){
//                echo "<pre>";
//                var_dump($items);die;
                $factura = new Facturas();
                $factura->SetSellerData($company);
                $factura->SetFacturasParams(1,$company->tin);
                $factura->status = Facturas::STATUS_REESTR;
                $factura->FacturaProductId = $this->getId();
                $factura->FacturaNo = (string)$items['FacNo'];
                $factura->FacturaDate = date('Y-m-d',strtotime($items['FacDate']));
                $factura->ContractNo = (string)$items['ContNo'];
                $factura->ContractDate = date('Y-m-d',strtotime($items['ContDate']));
                $number  = substr($items['Tin'],0,1);
                if($number==2 || $number==3) {
                    $buyerData = Json::decode(Components::getNp1($items['Tin']));
                    $nds_code = Components::getNdsCode($items['Tin'], 'regCode');
                    $factura->BuyerName = $buyerData['name'];
                    $factura->BuyerTin = (string)$items['Tin'];
                    $factura->BuyerAddress = $buyerData['address'];
                    $factura->BuyerOked = $buyerData['oked'];
                    $factura->BuyerAccount = $buyerData['account'];
                    $factura->BuyerAccountant = $buyerData['accountant'];
                    $factura->BuyerDistrictId = sprintf("%02d", $buyerData['ns10Code']) . sprintf("%02d", $buyerData['ns11Code']);
                    $factura->BuyerDirector = $buyerData['director'];
                    $factura->BuyerBankId = (string)$buyerData['mfo'];
                    $factura->BuyerVatRegCode = ($nds_code['success'] == true) ? $nds_code['result'] : "";
                } else{
                    $dataFiz = Components::getFizNp1($items['Tin']);
                    $dataFiz = Json::decode($dataFiz);
                    $factura->BuyerName = $dataFiz['fullName'];
                    $factura->BuyerTin = $items['Tin'];
                    $factura->BuyerAddress = $dataFiz['address'];
                    $factura->BuyerDistrictId = sprintf("%02d", $dataFiz['ns10Code']) . sprintf("%02d", $dataFiz['ns11Code']);
                }


                $factura->reestr_id = $model->id;
                $factura->created_date = date('Y-m-d H:i:s');
                $factura->AllSum = $items['ProductDeliverSum'];
                $factura->AllVatSum = $items['ProductDeliverySumWithVat'];
                if($factura->save()){
                    $products = new FacturaProducts();
                    $products->FacturaId = $factura->Id;
                    $products->OrdNo = "1";
                    $products->Name = $items['ProductName'];
                    $products->MeasureId = $items['ProductMeasureId'];
                    $products->Count = $items['ProductCount'];
                    $products->Summa = $items['ProductSumma'];
                    $products->DeliverySum = $items['ProductDeliverSum'];
                    $products->VatRate = $items['ProductVatRate'];
                    $products->VatSum = $items['ProductVatSum'];
                    $products->DeliverySumWithVat = $items['ProductDeliverySumWithVat'];
                    $products->ExciseRate = $items['ProductFuelRate'];
                    $products->ExciseSum =$items['ProductFuelSum'];
                    $products->WithoutVat = ($products->VatRate>0)?0:1;
                    if(!$products->save()){
                        $reason = Json::encode($products->getErrors());
                         $factura->delete();
                    }
//                    echo $products->DeliverySum;die;
                } else {
                    $reason = Json::encode($factura->getErrors()).$factura->BuyerTin;
                }
            }
            if($reason!==""){
                echo $reason;die;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReestrMain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReestrMain model.
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
     * Finds the ReestrMain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReestrMain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReestrMain::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
