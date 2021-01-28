<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPartsTemplateItems */

$this->title = Yii::t('main', 'Update Company Parts Template Items: {name}', [
    'name' => $model->Title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Company Parts Template Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('main', 'Update');
?>
<div class="company-parts-template-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
