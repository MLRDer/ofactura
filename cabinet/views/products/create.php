<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DocProducts */

$this->title = 'Create Doc Products';
$this->params['breadcrumbs'][] = ['label' => 'Doc Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
