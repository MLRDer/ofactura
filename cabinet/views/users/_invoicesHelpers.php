<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$model = \common\models\CompanyInvoicesHelpers::findAll(['company_id'=>\cabinet\models\Components::GetId()]);
?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>N</th>
            <th>Bank</th>
            <th>MFO</th>
            <th>Xisob raqami</th>
        </tr>
    </thead>
    <tbody>
    <?php $k=0; foreach ($model as $items){ $k++;?>
        <tr>
            <td><?= $k ?></td>
            <td><?= $items->name ?> </td>
            <td><?= $items->mfo ?></td>
            <td><?= $items->invoices_number ?> </td>
        </tr>

    <?php }?>
    </tbody>
</table>


