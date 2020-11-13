<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ExtraFunction */
?>
<div class="extra-function-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_ru',
            'path',
            'icon_data',
            'enabled',
        ],
    ]) ?>

</div>
