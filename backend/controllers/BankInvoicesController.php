<?php

namespace backend\controllers;

use cabinet\models\Components;
use common\models\Invoices;
use Yii;
use common\models\BankInvoicesLog;
use common\models\BankInvoicesLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BankInvoicesController implements the CRUD actions for BankInvoicesLog model.
 */
class BankInvoicesController extends \common\components\Controller
{
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

    /**
     * Lists all BankInvoicesLog models.
     * @return mixed
     */

    public function actionAdd($id){
        $checkLog = BankInvoicesLog::findOne(['id'=>$id]);
        if(!empty($checkLog)) {
            $check = Invoices::findOne(['bank_data_id' => $checkLog->id]);
            if(empty($check)) {
                $invoicesModel = new Invoices();
                $invoicesModel->company_id = Components::GetCompanyIdByTin($checkLog->clInn);
                $invoicesModel->tin = $checkLog->clInn;
                $invoicesModel->bank_data_id = $checkLog->id;
                $invoicesModel->reason = "Bank orqali xisobni to`ldirish amalga oshirildi";
                $invoicesModel->type_invoices = 1;
                $invoicesModel->created_date = date('Y-m-d H:i:s');
                $invoicesModel->value = $checkLog->sumPay / 100;
                $invoicesModel->type_pay = 2;
                $invoicesModel->enabled = 1;
                if($invoicesModel->save()){
                    return $this->redirect('/invoices/index');
                } else{
                    var_dump($invoicesModel->getErrors());die;
                }
            }
            return $this->redirect('index');
        }

        return $this->redirect('index');

    }


    public function actionIndex()
    {
        $searchModel = new BankInvoicesLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BankInvoicesLog model.
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

    /**
     * Creates a new BankInvoicesLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BankInvoicesLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BankInvoicesLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Deletes an existing BankInvoicesLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the BankInvoicesLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BankInvoicesLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BankInvoicesLog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
