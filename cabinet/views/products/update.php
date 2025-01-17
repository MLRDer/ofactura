<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DocProducts */

$this->title = 'Update Doc Products: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Doc Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doc-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
