<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyDocsItems */
?>
<div class="company-docs-items-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'docs_id',
            'name',
            'pay_type',
            'count',
            'price',
            'price_all',
            'tax_id',
        ],
    ]) ?>

</div>
