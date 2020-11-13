<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Aferta */

$this->title = 'Update Aferta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Afertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
