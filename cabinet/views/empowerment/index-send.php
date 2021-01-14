<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmpowermentSaerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main','Empowerments send');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"/>
        <path d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L4,21 C2.8954305,21 2,20.1045695 2,19 L2,15 L6.27924078,15 L6.82339262,16.6324555 C7.09562072,17.4491398 7.8598984,18 8.72075922,18 L15.381966,18 C16.1395101,18 16.8320364,17.5719952 17.1708204,16.8944272 L18.118034,15 L22,15 Z" id="Combined-Shape" fill="#000000"/>
        <path d="M2.5625,13 L5.92654389,7.01947752 C6.2807805,6.38972356 6.94714834,6 7.66969497,6 L16.330305,6 C17.0528517,6 17.7192195,6.38972356 18.0734561,7.01947752 L21.4375,13 L18.118034,13 C17.3604899,13 16.6679636,13.4280048 16.3291796,14.1055728 L15.381966,16 L8.72075922,16 L8.17660738,14.3675445 C7.90437928,13.5508602 7.1401016,13 6.27924078,13 L2.5625,13 Z" id="Path" fill="#000000" opacity="0.3"/>
    </g>
</svg>
										</span>
            <h3 class="kt-portlet__head-title">
                <?= $this->title ?>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">

                    <a href="/empowerment/create" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        <?= Yii::t('main','Yaratish Dovernost')?>
                    </a>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="la la-filter"></i>
                        <?= Yii::t('main','Filter search')?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">

        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'EmpowermentNo',
                'headerOptions' => ['style' => 'width:150px'],
                'format'=>'raw',
                'value'=>function($model){

                    return '<a href="/empowerment/view?id='.$model->id.'" class="btn btn-light btn-elevate btn-pill btn-block"><i class="flaticon-attachment"></i>  '.$model->EmpowermentNo.'</a>';
                }
            ],
            'AgentTin',

            'AgentFio',

            'SellerTin',
            'SellerName',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'headerOptions' => ['style' => 'width:145px'],
                'value'=>function($model){
                    $statuModel = \common\models\DocStatus::findOne(['id'=>$model->status]);
                    $html = '<span class="kt-badge  kt-badge--'.$statuModel['class_name'].' kt-badge--inline kt-badge--pill">'.$statuModel['name_'.Yii::$app->language].'</span>';
                    return $html;
                }
            ],
        ],
    ]); ?>


    </div>
</div>
<style>
    .table th, .table td {
        vertical-align: unset !important;
    }
</style>