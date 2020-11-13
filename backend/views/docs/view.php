<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Docs */
?>
<div class="docs-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'FacturaId',
            'FacturaNo',
            'FacturaDate',
            'ContractNo',
            'ContractDate',
            'EmpowermentNo',
            'EmpowermentDateOfIssue',
            'AgentFio',
            'AgentTin',
            'AgentFacturaId',
            'ItemReleasedFio',
            'SellerTin',
            'SellerName',
            'SellerAccount',
            'SellerBankId',
            'SellerAddress',
            'SellerMobile',
            'SellerWorkPhone',
            'SellerOked',
            'SellerDistrictId',
            'SellerDirector',
            'SellerAccountant',
            'SellerVatRegCode',
            'BuyerTin',
            'BuyerName',
            'BuyerAccount',
            'BuyerBankId',
            'BuyerAddress',
            'BuyerMobile',
            'BuyerWorkPhone',
            'BuyerOked',
            'BuyerDistrictId',
            'BuyerDirector',
            'BuyerAccountant',
            'BuyerVatRegCode',
            'docs_pks7:ntext',
            'json_data:ntext',
            'json_items:ntext',
            'created_date',
            'send_date',
            'accepted_date',
            'status',
            'type_doc',
            'enabled',
            'user_id',
            'HasFuel',
            'HasVat',
            'notes',
            'FacturaProductId',
            'reestr_id',
        ],
    ]) ?>

</div>
