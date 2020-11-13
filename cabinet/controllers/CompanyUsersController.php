<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use common\models\Users;
use Yii;
use common\models\CompanyUsers;
use common\models\CompanyUsersSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyUsersController implements the CRUD actions for CompanyUsers model.
 */
class CompanyUsersController extends \cabinet\components\Controller
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
     * Lists all CompanyUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['company_id'=>Components::GetId()]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyUsers model.
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
     * Creates a new CompanyUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyUsers();

        if ($model->load(Yii::$app->request->post())) {
            $userData =Json::decode( Components::getFizNp1($model->tin));

            $data = Users::findOne(['tin'=>$model->tin]);
            if(empty($data)){
                $data=new Users();
                $data->username = $model->tin;
                $data->tin = $model->tin;
                $data->fio = $userData['fullName'];
                $data->role_id = 1;
                $data->email = $model->tin."@noname.no";
                $data->created_at = strtotime(date('Y-m-d H:i:s'));
                $data->updated_at = strtotime(date('Y-m-d H:i:s'));
                $data->status = 10;
                $data->auth_key = Yii::$app->security->generateRandomString(32);
                $data->password_hash = Yii::$app->security->generateRandomString(32);
                $data->save();
            }

                $model->enabled = 0;
                $model->role_id = Json::encode($model->role_items);
                $model->users_id = $data->id;
                $model->role_items =0;
                $model->company_id = Components::GetId();
                $model->status = 2;
                if(!$model->save()) {
                    Yii::$app->session->setFlash('error',  'ERROR:'.Json::encode($model->getErrors()));
                    return $this->redirect(['create']);
                }
                return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompanyUsers model.
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
     * Deletes an existing CompanyUsers model.
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
     * Finds the CompanyUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyUsers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
