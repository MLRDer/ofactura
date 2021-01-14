<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2019-12-28
 * Time: 21:52
 */
/* @var $this yii\web\View */
/* @var $model common\models\Empowerment */
?>





    <?php if($model->status==5){ ?>

        <button  type="button" name="Send" class="btn-green m-r-20" onclick="AcceptEmpowerment(<?= $model->id ?>)">
            <img src="/new_template/images/icon/signature.svg" alt=""> <span class="title"><?= Yii::t('main','Imzolash')?></span>
        </button>
        <button  type="button" name="Send" class="btn-outline-red" onclick="RejectedEmpowerment(<?= $model->id ?>)">
             <?= Yii::t('main','Rad etish')?>
        </button>
    <?php }?>



