<?php

use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmpowermentSaerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main','Empowerments all');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="white-box">
    <div class="row m-b-20">
        <div class="col-md-6">
            <div class="page-title m-b-0"><?= $this->title ?></div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <a href="/empowerment/create" class="btn-gray border-right-0-margin-right-30 color-blue">+ <?= Yii::t('main', "Создать доверенность")?></a>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            $tab = Yii::$app->request->get('tab',"w3-tab0");
            echo Tabs::widget([
                'options'=>['class'=>'profile-tab-header'],
                'itemOptions'=>['class'=>'tab-pane fade show'],
                'headerOptions'=>['class'=>''],
                'items' => [
                    [
                        'label' => Yii::t('main', 'Входящие'),
                        'content' => $this->render('_columnsEmpowerment',[
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]),
                        'options'=>['onchange'=>'SetLastTabs(1)'],
                        'active' => ($tab=="w3-tab0")?true:false
                    ],
                    [
                        'label' => Yii::t('main', 'Отправленные'),
                        'options'=>['onclick'=>'SetLastTabs(2)'],
                        'content' => $this->render('_columnsEmpowerment',[
                            'searchModel' => $searchModel_sent,
                            'dataProvider' => $dataProvider_sent,
                        ]),
                        'active' => ($tab=="w3-tab1")?true:false
                    ],
                    [
                        'label' => Yii::t('main', 'Сохраненные'),
                        'options'=>['onclick'=>'SetLastTabs(3)'],
                        'content' => $this->render('_columnsEmpowerment',[
                            'searchModel' => $searchModel_saved,
                            'dataProvider' => $dataProvider_saved,
                        ]),
                        'active' => ($tab=="w3-tab2")?true:false
                    ],

                ],
            ]);
            ?>



        </div>
    </div>
</div>





<style>
    .table th, .table td {
        vertical-align: unset !important;
    }
</style>