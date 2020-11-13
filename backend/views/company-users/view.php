<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyUsers */
?>
<div class="company-users-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'users_id',
            'enabled',
            'status',
        ],
    ]) ?>

</div>
