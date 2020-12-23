<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Facturas;

/**
 * FacturasSearch represents the model behind the search form of `common\models\Facturas`.
 */
class FacturasSearch extends Facturas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'FacturaNo', 'FacturaDate', 'ContractNo', 'ContractDate', 'AgentFacturaId', 'EmpowermentNo', 'EmpowermentDateOfIssue', 'AgentFio', 'AgentTin', 'ItemReleasedFio', 'SellerTin', 'BuyerTin', 'SellerName', 'SellerAccount', 'SellerBankId', 'SellerAddress', 'SellerMobile', 'SellerWorkPhone', 'SellerOked', 'SellerDistrictId', 'SellerDirector', 'SellerAccountant', 'SellerVatRegCode', 'SellerBranchCode', 'SellerBranchName', 'BuyerName', 'BuyerAccount', 'BuyerBankId', 'BuyerAddress', 'BuyerMobile', 'BuyerWorkPhone', 'BuyerOked', 'BuyerDistrictId', 'BuyerDirector', 'BuyerAccountant', 'BuyerVatRegCode', 'BuyerBranchCode', 'BuyerBranchName', 'FacturaProductId', 'Tin'], 'safe'],
            [['Version', 'FacturaType', 'SingleSidedType', 'HasVat', 'HasExcise', 'HasCommittent', 'HasMedical', 'type', 'status'], 'integer'],
            [['AllSum', 'AllVatSum'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Facturas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->orderBy('created_date DESC');
        // grid filtering conditions
        $query->andFilterWhere([
            'Version' => $this->Version,
            'FacturaType' => $this->FacturaType,
            'SingleSidedType' => $this->SingleSidedType,
            'FacturaDate' => $this->FacturaDate,
            'ContractDate' => $this->ContractDate,
            'EmpowermentDateOfIssue' => $this->EmpowermentDateOfIssue,
            'HasVat' => $this->HasVat,
            'HasExcise' => $this->HasExcise,
            'HasCommittent' => $this->HasCommittent,
            'HasMedical' => $this->HasMedical,
            'AllSum' => $this->AllSum,
            'AllVatSum' => $this->AllVatSum,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'Id', $this->Id])
            ->andFilterWhere(['like', 'FacturaNo', $this->FacturaNo])
            ->andFilterWhere(['like', 'ContractNo', $this->ContractNo])
            ->andFilterWhere(['like', 'AgentFacturaId', $this->AgentFacturaId])
            ->andFilterWhere(['like', 'EmpowermentNo', $this->EmpowermentNo])
            ->andFilterWhere(['like', 'AgentFio', $this->AgentFio])
            ->andFilterWhere(['like', 'AgentTin', $this->AgentTin])
            ->andFilterWhere(['like', 'ItemReleasedFio', $this->ItemReleasedFio])
            ->andFilterWhere(['like', 'SellerTin', $this->SellerTin])
            ->andFilterWhere(['like', 'BuyerTin', $this->BuyerTin])
            ->andFilterWhere(['like', 'SellerName', $this->SellerName])
            ->andFilterWhere(['like', 'SellerAccount', $this->SellerAccount])
            ->andFilterWhere(['like', 'SellerBankId', $this->SellerBankId])
            ->andFilterWhere(['like', 'SellerAddress', $this->SellerAddress])
            ->andFilterWhere(['like', 'SellerMobile', $this->SellerMobile])
            ->andFilterWhere(['like', 'SellerWorkPhone', $this->SellerWorkPhone])
            ->andFilterWhere(['like', 'SellerOked', $this->SellerOked])
            ->andFilterWhere(['like', 'SellerDistrictId', $this->SellerDistrictId])
            ->andFilterWhere(['like', 'SellerDirector', $this->SellerDirector])
            ->andFilterWhere(['like', 'SellerAccountant', $this->SellerAccountant])
            ->andFilterWhere(['like', 'SellerVatRegCode', $this->SellerVatRegCode])
            ->andFilterWhere(['like', 'SellerBranchCode', $this->SellerBranchCode])
            ->andFilterWhere(['like', 'SellerBranchName', $this->SellerBranchName])
            ->andFilterWhere(['like', 'BuyerName', $this->BuyerName])
            ->andFilterWhere(['like', 'BuyerAccount', $this->BuyerAccount])
            ->andFilterWhere(['like', 'BuyerBankId', $this->BuyerBankId])
            ->andFilterWhere(['like', 'BuyerAddress', $this->BuyerAddress])
            ->andFilterWhere(['like', 'BuyerMobile', $this->BuyerMobile])
            ->andFilterWhere(['like', 'BuyerWorkPhone', $this->BuyerWorkPhone])
            ->andFilterWhere(['like', 'BuyerOked', $this->BuyerOked])
            ->andFilterWhere(['like', 'BuyerDistrictId', $this->BuyerDistrictId])
            ->andFilterWhere(['like', 'BuyerDirector', $this->BuyerDirector])
            ->andFilterWhere(['like', 'BuyerAccountant', $this->BuyerAccountant])
            ->andFilterWhere(['like', 'BuyerVatRegCode', $this->BuyerVatRegCode])
            ->andFilterWhere(['like', 'BuyerBranchCode', $this->BuyerBranchCode])
            ->andFilterWhere(['like', 'BuyerBranchName', $this->BuyerBranchName])
            ->andFilterWhere(['like', 'FacturaProductId', $this->FacturaProductId])
            ->andFilterWhere(['like', 'Tin', $this->Tin]);

        return $dataProvider;
    }
}
