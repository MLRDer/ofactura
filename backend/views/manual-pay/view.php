<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ManualPayLog */
?>
<div class="manual-pay-log-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'client_ip',
            'created_date',
            'pay_sum',
            'company_id',
            'descriptions',
            'type',
            'enabled',
        ],
    ]) ?>

</div>
