<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Aferta */

$this->title = 'Create Aferta';
$this->params['breadcrumbs'][] = ['label' => 'Afertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aferta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
