<?php

use yii\helpers\Html;
$this->title = "Tariflar"
/* @var $this yii\web\View */
/* @var $model common\models\CompanyTarif */
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
