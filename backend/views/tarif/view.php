<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyTarif */
?>
<div class="company-tarif-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'period',
            'value_doc',
            'month_mony',
            'price',
            'status',
            'type',
            'enabled',
        ],
    ]) ?>

</div>
