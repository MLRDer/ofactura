<?php

namespace cabinet\controllers;

use cabinet\models\Components;
use Yii;
use common\models\FormatNo;
use common\models\FormatNoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormatNumController implements the CRUD actions for FormatNo model.
 */
class FormatNumController extends \cabinet\components\Controller
{


    /**
     * Lists all FormatNo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormatNoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormatNo model.
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
     * Creates a new FormatNo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model_contract = FormatNo::findOne(['tin'=>Components::CompanyData('tin'),'type_doc'=>FormatNo::TYPE_CONTRACT]);
        $model_factura = FormatNo::findOne(['tin'=>Components::CompanyData('tin'),'type_doc'=>FormatNo::TYPE_FACTURAS]);
        $model_act = FormatNo::findOne(['tin'=>Components::CompanyData('tin'),'type_doc'=>FormatNo::TYPE_ACT]);
        if(empty($model_contract))
             $model_contract = FormatNo::SetDefaultData(FormatNo::TYPE_CONTRACT);
        if(empty($model_factura))
            $model_factura = FormatNo::SetDefaultData(FormatNo::TYPE_FACTURAS);
        if(empty($model_act))
            $model_act = FormatNo::SetDefaultData(FormatNo::TYPE_ACT);

        if (Yii::$app->request->post()) {
            $request = Yii::$app->request;
            $model_contract->after_number = $request->post('after_num_contract');
            $model_contract->number = $request->post('num_contract');
            $model_contract->before_number = $request->post('before_num_contract');
            $model_contract->enabled = $request->post('enabled_contract')=="on"?1:0;

            $model_contract->save();
            $model_factura->after_number = $request->post('after_num_factura');
            $model_factura->number = $request->post('num_factura');
            $model_factura->before_number = $request->post('before_num_factura');
            $model_factura->enabled = ($request->post('enabled_factura'))=="on"?1:0;
            $model_factura->save();

            $model_act->after_number = $request->post('after_num_act');
            $model_act->number = $request->post('num_act');
            $model_act->before_number = $request->post('before_num_act');
            $model_act->enabled = $request->post('enabled_act')=="on"?1:0;
            $model_act->save();
            return $this->redirect('create');



        }

        return $this->render('create', [
            'model_contract' => $model_contract,
            'model_factura' => $model_factura,
            'model_act' => $model_act,
        ]);
    }

    /**
     * Updates an existing FormatNo model.
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
     * Deletes an existing FormatNo model.
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
     * Finds the FormatNo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormatNo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FormatNo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }
}
