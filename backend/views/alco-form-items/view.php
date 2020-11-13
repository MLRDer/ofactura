<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AlcoFormItems */
?>
<div class="alco-form-items-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'form_id',
            'category_id',
            'label_uz',
            'label_ru',
            'input_type',
            'is_recured',
            'placeholder_uz',
            'placeholder_ru',
            'sort_order',
            'col_size_class',
        ],
    ]) ?>

</div>
