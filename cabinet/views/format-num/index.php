<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FormatNoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('main', 'Format Nos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="format-no-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('main', 'Create Format No'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tin',
            'type_doc',
            'after_number',
            'number',
            //'before_number',
            //'update_date',
            //'enabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
