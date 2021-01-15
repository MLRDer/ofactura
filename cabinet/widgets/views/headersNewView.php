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
    <?php
    $current_path = Yii::$app->request->url;

    $path_ru = substr_replace($current_path,"/ru",0,3);
    $path_uz = substr_replace($current_path,"/uz",0,3);
    $path_oz = substr_replace($current_path,"/oz",0,3);
    ?>

    <div class="control-panel">
        <a href="/invoices/payme" class="balance fill-score">
            <div class="icon"></div>

            <div class="balance-value"><?= number_format(Components::getSum(),2)?> сум</div>
        </a>



            <div class="dropdown lang-item">
                <a class="lang-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: block;margin-right: 30px">
                    <img src="/new_template/images/header/lang-<?= Yii::$app->language?>.svg" alt="" style="width: 30px">
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="<?= $path_uz?>">
                        <img src="/new_template/images/header/lang-uz.svg" alt="" style="width: 20px;
    float: left;
    margin-right: 20px;
    padding-top: 3px;"> Узб
                    </a>
                    <a class="dropdown-item" href="<?= $path_oz?>">
                        <img src="/new_template/images/header/lang-oz.svg" alt="" style="width: 20px;
    float: left;
    margin-right: 20px;
    padding-top: 3px;"> O'zb
                    </a>
                    <a class="dropdown-item" href="<?= $path_ru?>">
                        <img src="/new_template/images/header/lang-ru.svg" alt="" style="width: 20px;
    float: left;
    margin-right: 20px;
    padding-top: 3px;">    Рус
                    </a>

                </div>
            </div>

        <ul class="control-list">
            <li class="control-item">
                <a href="/classifications/index" class="control-link gear"></a>
            </li>
            <li class="control-item">
                <a href="/new_template/file/offer.pdf" class="control-link offer"></a>
            </li>
            <?php $ntf = \common\models\Notifications::find()->andWhere(['tin'=>Components::CompanyData('tin'),'is_view'=>1])->count() ?>
            <li class="control-item <?= ($ntf>0)?'active ':''?>">
                <a href="#!" class="control-link notification fill-score animation">
                    <?php if($ntf>0){  ?> <span class="count-bell"><?= $ntf?></span> <?php }?>
                </a>

            </li>
            <li class="control-item">
                <a href="/site/logout" class="control-link log-out"></a>
            </li>
        </ul>
    </div>
</header>
