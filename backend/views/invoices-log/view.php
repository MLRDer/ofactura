<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\InvoicesLog */
?>
<div class="invoices-log-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'succes_type',
            'reason',
            'created_date',
            'status',
            'enabled',
        ],
    ]) ?>

</div>
