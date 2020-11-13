<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Empowerment */
?>
<div class="empowerment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'EmpowermentId',
            'EmpowermentNo',
            'EmpowermentDateOfIssue',
            'EmpowermentDateOfExpire',
            'EmpowermentProductId',
            'ContractNo',
            'ContractDate',
            'AgentEmpowermentId',
            'AgentTin',
            'AgentJobTitle',
            'AgentPassportNumber',
            'AgentFio',
            'AgentPassportDateOfIssue',
            'AgentPassportIssuedBy',
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
            'items_json:ntext',
            'docs_pks7:ntext',
            'status',
            'type',
            'enabled',
            'created_date',
        ],
    ]) ?>

</div>
