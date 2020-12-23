<?php
/**
 * Created by PhpStorm.
 * User: Jasmina
 * Date: 20.12.2020
 * Time: 23:40
 */

use kartik\date\DatePicker;

?>
<div class="row">

<div class="col-md-6">
    <div class="input">
    <?= $form->field($model, 'OldFacturaNo')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="col-md-6">
    <div class="input">
        <?php
        echo $form->field($model, 'OldFacturaDate',['template'=>'{label}<div class="input datepicker-wrapper my-datepicker-icon">{input}</div>{error}'])->widget(DatePicker::classname(), [
            'options' => ['class'=>'my-datepicker'],
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoclose'=>true,
                'todayHighlight' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
        ?>

    </div>
</div>
</div>