<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EmpowermentProduct */

$this->title = 'Update Empowerment Product: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Empowerment Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empowerment-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
