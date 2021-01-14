<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use Yii;
use common\models\Company;
use common\models\CompanySearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends \cabinet\components\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionUpdateData(){
        $model = Company::findOne(['id'=>Components::GetId()]);
        $reason="";
        if(empty($model))
            $reason = "Korxona topilmadi";
        if($reason==""){
            $tin = Components::CompanyData('tin');
            $number  = substr($tin,0,1);
            if($number==2 || $number==3) {
                $data = Components::getNp1($tin);
                $data = Json::decode($data);
                $nds = Components::getNdsCode($tin,'regCode');
                echo "<pre>";
//                var_dump($data);die;
                $model->name = $data['name'];
                $model->address = $data['address'];
                $model->ns10_code = $data['ns10Code'];
                $model->ns11_code = $data['ns11Code'];
                $model->mfo = $data['mfo'];
                $model->oked = $data['oked'];
                $model->director_tin = $data['directorTin'];
                $model->director = $data['director'];
                $model->accountant = $data['accountant'];
                if(!$model->save()){
                    $reason = Json::encode($model->getErrors());
                }

            } else {
                $data = Components::getFizNp1($tin);
                $data = Json::decode($data);
            }
        }

        if($reason ==""){
            Yii::$app->session->setFlash('success', "Янгланиш муафияыатли амалга оширилди.");
        } else {
            Yii::$app->session->setFlash('error', $reason);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model.
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
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
