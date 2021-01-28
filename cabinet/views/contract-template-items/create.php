<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPartsTemplateItems */

$this->title = Yii::t('main', 'Create Company Parts Template Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Company Parts Template Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-parts-template-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
