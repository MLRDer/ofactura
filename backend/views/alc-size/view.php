<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AlcSize */
?>
<div class="alc-size-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
