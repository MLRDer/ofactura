<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AlcoCategory */
?>
<div class="alco-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_ru',
            'sort_order',
        ],
    ]) ?>

</div>
