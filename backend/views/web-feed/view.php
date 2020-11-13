<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WebFeedBack */
?>
<div class="web-feed-back-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_oz',
            'name_ru',
            'body_uz:ntext',
            'body_oz:ntext',
            'body_ru:ntext',
            'sort_order',
            'enabled',
        ],
    ]) ?>

</div>
