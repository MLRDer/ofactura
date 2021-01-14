<?php

namespace cabinet\controllers;

use common\models\AlcoCategory;
use common\models\AlcoForm;
use common\models\AlcoFormItems;
use Yii;
use common\models\Company;
use common\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class ExtraController extends \cabinet\components\Controller
{


    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionAlcoExtra()
    {


        $model = AlcoCategory::find()->all();
        $result = [
           'success'=>true,
           'html'=>$this->renderPartial('alco_name_generator',['model'=>$model])
        ];

        return $result;
    }

    public function actionCreateForm()
    {
        $id = Yii::$app->request->post('id');
        $form = AlcoForm::findOne(['category_id'=>$id]);
        $reason = "";
        if(empty($form)){
            $reason = "Forma yaratilmagan";
        }
        if($reason==""){
            $model = AlcoFormItems::find()->andWhere(['form_id'=>$form->id,'category_id'=>$id])->orderBy("sort_order ASC")->all();
            if(empty($model)){
                $reason="Forma elementlari mavjud emas";
            }
        }

        if($reason==""){
            $result = [
                'success'=>true,
                'html'=>$this->renderPartial('alco_form',['model'=>$model])
            ];
        } else {
            $result = [
                'success'=>true,
                'html'=>'<div class="alert alert-danger" role="alert">'.$reason.'</div>'
            ];
        }
        return $result;
    }

}
