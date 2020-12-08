<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use common\models\Company;
use common\models\CompanyUsers;
use common\models\DocInData;
use common\models\DocInDataLog;
use common\models\DocMeasure;
use common\models\DocProducts;
use common\models\DocStatus;
use common\models\Empowerment;
use common\models\EmpowermentInData;
use common\models\EmpowermentProduct;
use common\models\FacturaPks7;
use common\models\Facturas;
use function GuzzleHttp\Psr7\str;
use Yii;
use common\models\Docs;
use common\models\DocsSearch;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocController implements the CRUD actions for Docs model.
 */
class ApiV2Controller extends Controller
{
    /**
     * {@inheritdoc}
     */
//    const HOST = "https://facturatest.yt.uz";
    const HOST = "https://factura.yt.uz";
    const LOGIN = "onlinefactura";
    const PASSWORD = "n;xw3CE(GDb$@|D*";

    const URL_PKCS = "http://127.0.0.1:9090/dsvs/pkcs7/v1?wsdl";

    /**
     * Lists all Docs models.
     * @return mixed
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionGetSigned(){

        $id = Yii::$app->request->post('factura_id');
        $modelPks = FacturaPks7::findOne(['factura_id'=>$id]);
        if(empty($modelPks)) {
            $model = Facturas::findOne(['Id' => $id]);
            $opts = array(
                'http' => array(
                    'method' => "GET",
                    'header' => "Authorization: Basic " . base64_encode(self::LOGIN . ":" . self::PASSWORD)
                )
            );
            $reason = "";
            $context = stream_context_create($opts);
            $tin = Components::CompanyData('tin');
            $url = Yii::$app->params['factura_host'] . "/provider/api/uz/{$model->SellerTin}/facturas/seller/signedfile/" . $id;
            $data = file_get_contents($url, false, $context);
            return $data;
        } else {
            return $modelPks->seller_pks7;
        }
    }

    public function actionGetClassifications(){

        try {
            $tin = Components::CompanyData('tin');
            $opts = array(
                'http' => array(
                    'method' => "GET",
                    'header' => "Authorization: Basic " . base64_encode("onlinefactura:9826315157e93a13e05$")
                )
            );
            $context = stream_context_create($opts);
            $url = 'http://my.soliq.uz/services/cl-api/class/get-list/by-company?tin='.$tin;
            $data = file_get_contents( $url, false, $context);
            echo "<pre>";
            var_dump(
                Json::decode($data)
            );
            die;
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function actionGetFactura(){

        $id = Yii::$app->request->post('id');
        $model = Facturas::findOne(['Id'=>$id]);
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic " . base64_encode(self::LOGIN.":".self::PASSWORD)
            )
        );
        $reason ="";
        $context = stream_context_create($opts);
        $tin = Components::CompanyData('tin');
        $url = Yii::$app->params['factura_host']."/provider/api/uz/{$tin}/facturas/buyer/".$id;
        $data = file_get_contents($url, false, $context);
        return $data;
    }


    public function actionProductsGrid(){
        $type = Yii::$app->request->post('type');
        $id = Yii::$app->request->post('id');
        if($id==null)
            $model = new Facturas();
        else
            $model = Facturas::findOne(['id'=>$id]);
        switch ($type){
            case "1":
                $file = "_gridWithFuel";
                break;
            case "2":
                $file = "_gridWithOutFuel";
                break;
            case "3":
                $file = "_gridWithFuel";
                break;

        }

        $result =[
            'success'=>true,
            'test'=>$file,
            'html'=>$this->renderPartial($file,['model'=>$model])
        ];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

    public function actionGetJson(){
        $factura_id = Yii::$app->request->post('id');
        $model = Facturas::findOne(['Id'=>$factura_id]);
        if(!empty($model))
            return $model->GetJsonData();
        return [];
    }


}
