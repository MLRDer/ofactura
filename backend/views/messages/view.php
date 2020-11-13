<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SourceMessage */
?>
<div class="source-message-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'key_name',
            'name_uz',
            'name_ru',
            'name_oz',
            'enabled',
        ],
    ]) ?>

</div>
