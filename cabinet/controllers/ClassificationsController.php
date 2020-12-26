<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use Yii;
use common\models\Classifications;
use common\models\ClassificationsSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClassificationsController implements the CRUD actions for Classifications model.
 */
class ClassificationsController extends \cabinet\components\Controller
{
    /**
     * {@inheritdoc}
     */


    public function actionGetData(){
        $reason="";
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
            $data = Json::decode($data);
            if($data['success']==true){

                foreach ($data['data'] as $items) {
                    $model = Classifications::find()->andWhere(['groupCode'=>$items['groupCode'], 'tin'=>Components::CompanyData('tin')])->one();
                    if(empty($model))
                        $model = new Classifications();
                    $model->tin = (string)Components::CompanyData('tin');
                    $model->groupCode = $items['groupCode'];
                    $model->classCode = $items['classCode'];
                    $model->className = strip_tags($items['className']);
                    $model->productCode = $items['productCode'];
                    $model->productName = $items['productName'];
                        if(!$model->save()){
                            $reason = Json::encode($model->getErrors()."- ",$items['className']);
                        }
                    }
            }

        }
        catch (\Exception $exception){
            $reason = $exception->getMessage();
        }

        if($reason==""){
            Yii::$app->session->setFlash('success', "Malumotlar qabul qilindi.");
        } else {
            Yii::$app->session->setFlash('error', $reason);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Lists all Classifications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClassificationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['tin'=>Components::CompanyData('tin')]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Classifications model.
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
     * Creates a new Classifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Classifications();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Classifications model.
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
     * Deletes an existing Classifications model.
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
     * Finds the Classifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Classifications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }
}
