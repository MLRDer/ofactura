<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EmpowermentProduct */

$this->title = 'Create Empowerment Product';
$this->params['breadcrumbs'][] = ['label' => 'Empowerment Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empowerment-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
