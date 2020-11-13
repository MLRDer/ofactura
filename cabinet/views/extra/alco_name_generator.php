<?php
/**
 * Created by PhpStorm.
 * User: shodlik
 * Date: 2020-01-23
 * Time: 23:13
 */





?>

<form>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="recipient-name" class="form-control-label">Тип</label>
                <select class="form-control" id="type_product" onchange="AlcoGeneratForm(this.value)">
                    <?php foreach ($model as $items){ ?>
                        <option value="<?= $items->id ?>"><?= $items->name_uz?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div id="AlcoDynamicFormArea" style="width: 100%">

        </div>


    </div>
</form>