<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DocStatus */
?>
<div class="doc-status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_ru',
            'type',
        ],
    ]) ?>

</div>
