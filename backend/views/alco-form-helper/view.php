<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AlcoFormHelper */
?>
<div class="alco-form-helper-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'form_items_id',
            'name_uz',
            'name_ru',
            'form_id',
        ],
    ]) ?>

</div>
