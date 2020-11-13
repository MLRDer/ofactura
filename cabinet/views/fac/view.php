<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Factura */
?>
<div class="factura-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'Version',
            'FacturaType',
            'SingleSidedType',
            'FacturaNo',
            'FacturaDate',
            'ContractNo',
            'ContractDate',
            'AgentFacturaId',
            'EmpowermentNo',
            'EmpowermentDateOfIssue',
            'AgentFio',
            'AgentTin',
            'ItemReleasedFio',
            'SellerTin',
            'BuyerTin',
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
            'SellerBranchCode',
            'SellerBranchName',
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
            'BuyerBranchCode',
            'BuyerBranchName',
            'FacturaProductId',
            'Tin',
            'HasVat',
            'HasExcise',
            'HasCommittent',
            'HasMedical',
            'AllSum',
            'AllVatSum',
            'type',
            'status',
        ],
    ]) ?>

</div>
