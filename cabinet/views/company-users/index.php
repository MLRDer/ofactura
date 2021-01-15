<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanyUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Users';
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

                    <a href="/company-users/create" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        <?= Yii::t('main','Foydanaluvchi qoshish')?>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            [
               'headerOptions' => ['style' => 'width:45px'],
               'attribute'=>'tin',
               'format'=>'html',
               'value'=>function($model){
                    return "<b>".$model->tin."</b>";
               }
            ],
            'fio',

            [
                'attribute'=>'enabled',
                'headerOptions' => ['style' => 'width:85px'],
                'format'=>'html',
                'value'=>function($model){
                    $status = "";
                    if($model->enabled==1){
                        $status = "<span class='kt-badge kt-badge--success kt-badge--inline btn-block'>Faol</span>";
                    } else{
                        $status = "<span class='kt-badge kt-badge--danger kt-badge--inline btn-block'>No faol</span>";
                    }


                    return $status;
                }
            ],
            [
                'headerOptions' => ['style' => 'width:150px'],
                'format'=>'raw',
                'value'=>function($model){

                    $result="";
                if($model->role_id!=null && $model->enabled==0) {
                    $json = [
                        'Tin'=>\cabinet\models\Components::CompanyData('tin'),
                        'FizTin'=>$model->tin,
                        'Fio'=>$model->fio,
                        'Roles'=>\yii\helpers\Json::decode($model->role_id)
                    ];
                    $json = \yii\helpers\Json::encode($json);

                    $input = "<input type='hidden' id = 'ID".$model->id."'  value='".$json."'>";
                    $result = $input . "<span class='btn btn-primary btn-xs' onclick='AcceptRole(" . $model->id . ")'><i class='fa flaticon2-correct
'></i> Imzolash</span>";
                }

                if($model->role_id!=null && $model->enabled==1) {
                    $json = [
                        'Tin'=>\cabinet\models\Components::CompanyData('tin'),
                        'FizTin'=>$model->tin,
                        'Fio'=>$model->fio,
                        'Roles'=>""
                    ];
                    $json = \yii\helpers\Json::encode($json);

                    $input = "<input type='hidden' id = 'ID".$model->id."'  value='".$json."'>";
                    $result = $input . "<span class='btn btn-danger btn-xs' onclick='CancelRole(" . $model->id . ")'><i class='fa flaticon2-close-cross
'></i> Bekor qilish</span>";
                }

                return $result;

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