<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Acts */

$this->title = Yii::t('main', 'Create Acts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Acts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
