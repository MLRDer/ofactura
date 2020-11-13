<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class EspController extends \common\components\Controller
{

    public function actionAuth()
    {
        $id = Yii::$app->request->get('id');
        $data = Yii::$app->request->get('data');




     return 0;
    }


    public function actionCheck($url){
        print_r(file_get_contents($url));
    }
}
