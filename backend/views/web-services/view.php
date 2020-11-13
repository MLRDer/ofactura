<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WebServices */
?>
<div class="web-services-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_oz',
            'name_ru',
            'anons_uz',
            'anons_oz',
            'anons_ru',
            'icon',
            'sort_order',
            'enabled',
        ],
    ]) ?>

</div>
