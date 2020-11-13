<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyTarifLog */
?>
<div class="company-tarif-log-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'tarif_id',
            'created_date',
            'change_date',
            'send_value',
            'remain_value',
            'status',
            'enabled',
        ],
    ]) ?>

</div>
