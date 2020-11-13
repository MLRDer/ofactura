<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AlcMaterial */
?>
<div class="alc-material-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

</div>
