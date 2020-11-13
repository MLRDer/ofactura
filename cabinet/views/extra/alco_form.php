<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-01-23
 * Time: 23:53
 */
$form_items =[];
?>




<?php foreach ($model as $items){
    $form_items[] = $items->id;

    ?>


<div class="<?= ($items->col_size_class==null)?"col-md-12":$items->col_size_class ?>">
    <div class="form-group">
        <label for="recipient-name" class="form-control-label"><?= $items->label_uz ?></label>
        <?php if($items->input_type==2){ ?>
            <select class="form-control" id="name_<?= $items->id?>" onchange="AlcoholName()">
                <?php
                $helper = \common\models\AlcoFormHelper::findAll(['form_items_id'=>$items->id]);
                foreach ($helper  as $item){ ?>
                    <option value="<?= $item->name_uz ?>"><?= $item->name_uz ?></option>
                <?php }?>
            </select>
        <?php }?>
        <?php if($items->input_type==1){ ?>
            <input class="form-control" id="name_<?= $items->id?>" type="text" onkeyup="AlcoholName()">
        <?php }?>
    </div>
</div>

<?php }?>

<div class="col-md-12">
    <div class="form-group">
        <label class="form-control-label"><?= Yii::t('main','Result txt')?></label>
        <input class="form-control" id="all_name" type="text" disabled>
    </div>

</div>



<input type="hidden" value="<?= \yii\helpers\Json::encode($form_items) ?>" id="form-items">