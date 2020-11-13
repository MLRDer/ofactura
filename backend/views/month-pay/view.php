<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MonthPay */
?>
<div class="month-pay-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'value',
            'created_date',
            'end_date',
            'enabled',
            'tarif_id',
        ],
    ]) ?>

</div>
