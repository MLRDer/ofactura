<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */
$model->type = Yii::$app->request->get('type');
?>
<div class="source-message-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
