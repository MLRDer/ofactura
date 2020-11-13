<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-03-01
 * Time: 14:22
 */?>

<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?= Yii::t('main','Limit:')?> <?= Yii::$app->request->get('limit',10) ?>                            <?php $url_current =Yii::$app->request->getBaseUrl() ?>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
        <a class="dropdown-item" href="<?= $url_current?>?limit=10">10</a>
        <a class="dropdown-item" href="<?= $url_current?>?limit=20">20</a>
        <a class="dropdown-item" href="<?= $url_current?>?limit=50">50</a>
        <a class="dropdown-item" href="<?= $url_current?>?limit=100">100</a>
    </div>

</div>
