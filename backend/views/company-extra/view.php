<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyExtra */
?>
<div class="company-extra-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'extra_id',
            'enabled',
        ],
    ]) ?>

</div>
