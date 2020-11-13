<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
?>
<div class="company-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'tin',
            'ns10_code',
            'ns11_code',
            'name',
            'address',
            'oked',
            'invoices_sum',
            'tarif_id',
            'director_tin',
            'director',
            'accountant',
            'phone',
            'status',
            'type',
            'enabled',
            'is_aferta',
            'is_online',
            'count_login',
            'aferta_text:ntext',
            'start_month',
            'end_month',
        ],
    ]) ?>

</div>
