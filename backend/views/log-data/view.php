<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DocInDataLog */
?>
<div class="doc-in-data-log-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'doc_data_id',
            'success_type',
            'reason_msg',
            'created_date',
            'status',
            'enabled',
        ],
    ]) ?>

</div>
