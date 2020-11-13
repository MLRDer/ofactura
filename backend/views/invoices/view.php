<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Invoices */
?>
<div class="invoices-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'type_invoices',
            'created_date',
            'value',
            'tarif_id',
            'type_pay',
            'status',
            'enabled',
        ],
    ]) ?>

</div>
