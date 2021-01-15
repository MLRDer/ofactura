<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Empowerment;

/**
 * EmpowermentSearch represents the model behind the search form about `common\models\Empowerment`.
 */
class EmpowermentSearch extends Empowerment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'AgentTin', 'SellerOked', 'BuyerOked', 'status', 'type', 'enabled'], 'integer'],
            [['EmpowermentId', 'EmpowermentNo', 'EmpowermentDateOfIssue', 'EmpowermentDateOfExpire', 'EmpowermentProductId', 'ContractNo', 'ContractDate', 'AgentEmpowermentId', 'AgentJobTitle', 'AgentPassportNumber', 'AgentFio', 'AgentPassportDateOfIssue', 'AgentPassportIssuedBy', 'SellerTin', 'SellerName', 'SellerAccount', 'SellerBankId', 'SellerAddress', 'SellerMobile', 'SellerWorkPhone', 'SellerDistrictId', 'SellerDirector', 'SellerAccountant', 'BuyerTin', 'BuyerName', 'BuyerAccount', 'BuyerBankId', 'BuyerAddress', 'BuyerMobile', 'BuyerWorkPhone', 'BuyerDistrictId', 'BuyerDirector', 'BuyerAccountant', 'items_json', 'docs_pks7', 'created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'EmpowermentDateOfIssue' => $this->EmpowermentDateOfIssue,
            'EmpowermentDateOfExpire' => $this->EmpowermentDateOfExpire,
            'ContractDate' => $this->ContractDate,
            'AgentTin' => $this->AgentTin,
            'AgentPassportDateOfIssue' => $this->AgentPassportDateOfIssue,
            'SellerOked' => $this->SellerOked,
            'BuyerOked' => $this->BuyerOked,
            'status' => $this->status,
            'type' => $this->type,
            'enabled' => $this->enabled,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'EmpowermentId', $this->EmpowermentId])
            ->andFilterWhere(['like', 'EmpowermentNo', $this->EmpowermentNo])
            ->andFilterWhere(['like', 'EmpowermentProductId', $this->EmpowermentProductId])
            ->andFilterWhere(['like', 'ContractNo', $this->ContractNo])
            ->andFilterWhere(['like', 'AgentEmpowermentId', $this->AgentEmpowermentId])
            ->andFilterWhere(['like', 'AgentJobTitle', $this->AgentJobTitle])
            ->andFilterWhere(['like', 'AgentPassportNumber', $this->AgentPassportNumber])
            ->andFilterWhere(['like', 'AgentFio', $this->AgentFio])
            ->andFilterWhere(['like', 'AgentPassportIssuedBy', $this->AgentPassportIssuedBy])
            ->andFilterWhere(['like', 'SellerTin', $this->SellerTin])
            ->andFilterWhere(['like', 'SellerName', $this->SellerName])
            ->andFilterWhere(['like', 'SellerAccount', $this->SellerAccount])
            ->andFilterWhere(['like', 'SellerBankId', $this->SellerBankId])
            ->andFilterWhere(['like', 'SellerAddress', $this->SellerAddress])
            ->andFilterWhere(['like', 'SellerMobile', $this->SellerMobile])
            ->andFilterWhere(['like', 'SellerWorkPhone', $this->SellerWorkPhone])
            ->andFilterWhere(['like', 'SellerDistrictId', $this->SellerDistrictId])
            ->andFilterWhere(['like', 'SellerDirector', $this->SellerDirector])
            ->andFilterWhere(['like', 'SellerAccountant', $this->SellerAccountant])
            ->andFilterWhere(['like', 'BuyerTin', $this->BuyerTin])
            ->andFilterWhere(['like', 'BuyerName', $this->BuyerName])
            ->andFilterWhere(['like', 'BuyerAccount', $this->BuyerAccount])
            ->andFilterWhere(['like', 'BuyerBankId', $this->BuyerBankId])
            ->andFilterWhere(['like', 'BuyerAddress', $this->BuyerAddress])
            ->andFilterWhere(['like', 'BuyerMobile', $this->BuyerMobile])
            ->andFilterWhere(['like', 'BuyerWorkPhone', $this->BuyerWorkPhone])
            ->andFilterWhere(['like', 'BuyerDistrictId', $this->BuyerDistrictId])
            ->andFilterWhere(['like', 'BuyerDirector', $this->BuyerDirector])
            ->andFilterWhere(['like', 'BuyerAccountant', $this->BuyerAccountant])
            ->andFilterWhere(['like', 'items_json', $this->items_json])
            ->andFilterWhere(['like', 'docs_pks7', $this->docs_pks7]);

        return $dataProvider;
    }
}
