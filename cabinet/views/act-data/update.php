<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Acts */

$this->title = Yii::t('main', 'Update Acts: {name}', [
    'name' => $model->Id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Acts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('main', 'Update');
?>
<div class="acts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
