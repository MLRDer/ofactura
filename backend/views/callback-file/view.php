<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CallbackFile */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Callback Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

if (!is_file(file_get_contents(Yii::getAlias("@cabinet")."/web/".$model->path))) {
    $file = file_get_contents(Yii::getAlias("@cabinet")."/web/".$model->path);
} else{
    $file = "File topilmadi";
}
?>
<div class="callback-file-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p style="word-break: break-all">
       <?php
       echo $file
       ?>
    </p>

</div>
