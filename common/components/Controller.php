<?php


namespace common\components;


use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Controller extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error','login'],
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
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }


}