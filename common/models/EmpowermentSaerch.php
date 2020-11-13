<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Empowerment;

/**
 * EmpowermentSaerch represents the model behind the search form of `common\models\Empowerment`.
 */
class EmpowermentSaerch extends Empowerment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'AgentTin', 'SellerTin', 'SellerBankId', 'SellerOked', 'SellerDistrictId', 'BuyerTin', 'BuyerBankId', 'BuyerOked', 'BuyerDistrictId', 'status', 'type', 'enabled'], 'integer'],
            [['EmpowermentNo', 'EmpowermentDateOfIssue', 'EmpowermentDateOfExpire', 'ContractNo', 'ContractDate', 'AgentJobTitle', 'AgentPassportNumber', 'AgentFio', 'AgentPassportDateOfIssue', 'AgentPassportIssuedBy', 'SellerName', 'SellerAccount', 'SellerAddress', 'SellerMobile', 'SellerWorkPhone', 'SellerDirector', 'SellerAccountant', 'BuyerName', 'BuyerAccount', 'BuyerAddress', 'BuyerMobile', 'BuyerWorkPhone', 'BuyerDirector', 'BuyerAccountant'], 'safe'],
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
        $query = Empowerment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->orderBy("id DESC");

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'EmpowermentDateOfIssue' => $this->EmpowermentDateOfIssue,
            'EmpowermentDateOfExpire' => $this->EmpowermentDateOfExpire,
            'ContractDate' => $this->ContractDate,
            'AgentTin' => $this->AgentTin,
            'AgentPassportDateOfIssue' => $this->AgentPassportDateOfIssue,
            'SellerTin' => $this->SellerTin,
            'SellerBankId' => $this->SellerBankId,
            'SellerOked' => $this->SellerOked,
            'SellerDistrictId' => $this->SellerDistrictId,
            'BuyerTin' => $this->BuyerTin,
            'BuyerBankId' => $this->BuyerBankId,
            'BuyerOked' => $this->BuyerOked,
            'BuyerDistrictId' => $this->BuyerDistrictId,
            'status' => $this->status,
            'type' => $this->type,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'EmpowermentNo', $this->EmpowermentNo])
            ->andFilterWhere(['like', 'ContractNo', $this->ContractNo])
            ->andFilterWhere(['like', 'AgentJobTitle', $this->AgentJobTitle])
            ->andFilterWhere(['like', 'AgentPassportNumber', $this->AgentPassportNumber])
            ->andFilterWhere(['like', 'AgentFio', $this->AgentFio])
            ->andFilterWhere(['like', 'AgentPassportIssuedBy', $this->AgentPassportIssuedBy])
            ->andFilterWhere(['like', 'SellerName', $this->SellerName])
            ->andFilterWhere(['like', 'SellerAccount', $this->SellerAccount])
            ->andFilterWhere(['like', 'SellerAddress', $this->SellerAddress])
            ->andFilterWhere(['like', 'SellerMobile', $this->SellerMobile])
            ->andFilterWhere(['like', 'SellerWorkPhone', $this->SellerWorkPhone])
            ->andFilterWhere(['like', 'SellerDirector', $this->SellerDirector])
            ->andFilterWhere(['like', 'SellerAccountant', $this->SellerAccountant])
            ->andFilterWhere(['like', 'BuyerName', $this->BuyerName])
            ->andFilterWhere(['like', 'BuyerAccount', $this->BuyerAccount])
            ->andFilterWhere(['like', 'BuyerAddress', $this->BuyerAddress])
            ->andFilterWhere(['like', 'BuyerMobile', $this->BuyerMobile])
            ->andFilterWhere(['like', 'BuyerWorkPhone', $this->BuyerWorkPhone])
            ->andFilterWhere(['like', 'BuyerDirector', $this->BuyerDirector])
            ->andFilterWhere(['like', 'BuyerAccountant', $this->BuyerAccountant]);

        return $dataProvider;
    }
}
