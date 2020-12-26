<?php
use cabinet\models\Components;
?>
<header>
    <div class="user-info">
        <div class="user-name">
            <?php

            $cntCompany = \common\models\CompanyUsers::find()
                ->select("cu.*, c.name")
                ->from(\common\models\CompanyUsers::tableName() . ' cu')
                ->innerJoin(\common\models\Company::tableName() . ' c', 'c.id=cu.company_id')
                ->andWhere(['cu.users_id' => Yii::$app->user->id, 'cu.enabled' => 1]);

            if($cntCompany->count()>1){
                ?>
                <select class="form-control" onchange="location.href='/doc/change?id='+this.value" style="font-size: 22px;color:black;height: 40px;padding-top: 4px;padding-left: 5px;">
                    <?php foreach ($cntCompany->all() as $items){ ?>
                        <option value="<?= $items->id ?>" <?= $items->company_id==Components::GetId()?'selected':'' ?>> <?= $items->name ?></option>
                    <?php }?>
                </select>

            <?php } else {?>
                <?= Components::CompanyData('name')?>
            <?php }?>
        </div>
        <div class="user-tin">
            <div class="label">ИНН:</div>
            <div class="tin"><?= Components::CompanyData('tin')?></div>
        </div>
    </div>
    <div class="control-panel">
        <a href="/invoices/payme" class="balance fill-score">
            <div class="icon"></div>
            <div class="balance-value"><?= number_format(Components::getSum(),2)?> сум</div>
        </a>
        <ul class="lang-list">
            <li class="lang-item <?= (Yii::$app->language=="uz")?'active':''?>">
                <a href="/ru" class="lang-link">
                    <img src="/new_template/images/header/lang-ru.svg" alt="">
                </a>
            </li>
            <li class="lang-item <?= (Yii::$app->language=="ru")?'active':''?>">
                <a href="/uz" class="lang-link">
                    <img src="/new_template/images/header/lang-uz.svg" alt="">
                </a>
            </li>
        </ul>
        <ul class="control-list">
            <li class="control-item">
                <a href="/classifications/index" class="control-link gear"></a>
            </li>
            <li class="control-item">
                <a href="/new_template/file/offer.pdf" class="control-link offer"></a>
            </li>
            <li class="control-item active">
                <a href="#!" class="control-link notification"></a>
            </li>
            <li class="control-item">
                <a href="/site/logout" class="control-link log-out"></a>
            </li>
        </ul>
    </div>
</header>
