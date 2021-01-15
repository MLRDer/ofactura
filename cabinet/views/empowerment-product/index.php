<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EmpowermentProductSaerch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empowerment Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empowerment-product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Empowerment Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'empowerment_id',
            'Name',
            'MeasureId',
            //'Count',
            //'enabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
