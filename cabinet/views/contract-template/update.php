<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPartsTemplate */

$this->title = Yii::t('main', 'Update Company Parts Template: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Company Parts Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('main', 'Update');
?>
<div class="company-parts-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
