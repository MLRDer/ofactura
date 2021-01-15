<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CallbackFile */

$this->title = 'Create Callback File';
$this->params['breadcrumbs'][] = ['label' => 'Callback Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="callback-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
