<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WebMenyu */
?>
<div class="web-menyu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'name_oz',
            'name_ru',
            'name_uz',
            'icon',
            'path',
            'sort_order',
            'enabled',
        ],
    ]) ?>

</div>
