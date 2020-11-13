<?php


namespace cabinet\components;


use cabinet\models\Components;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class Controller extends \common\components\Controller
{
    public function behaviors()
    {

        $is_aferta = Components::CompanyData('is_aferta');
        if($is_aferta==0){
            $this->layout = "mainAferta";
        }
        $session = Yii::$app->session->get('mode','min');
        if($session=="max")
            $this->layout = "mainFull";

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error','login', 'callback','auth','accept','send','reject','cancel'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['post'],
//                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }
}