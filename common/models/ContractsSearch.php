<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contracts;

/**
 * ContractsSearch represents the model behind the search form of `common\models\Contracts`.
 */
class ContractsSearch extends Contracts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'ContractName', 'ContractNo', 'ContractDate', 'ContractExpireDate', 'ContractPlace', 'Tin', 'Name', 'Address', 'WorkPhone', 'Mobile', 'Fax', 'Oked', 'Account', 'BankId', 'FizTin', 'Fio', 'BranchCode', 'BranchName', 'json_items', 'clients', 'parts'], 'safe'],
            [['HasVat', 'status', 'type', 'created_date'], 'integer'],
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
        $query = Contracts::find();

        $query->select("c.*")->from(\common\models\Contracts::tableName()." c");
        $query->leftJoin(ContractClients::tableName()." cc", "cc.contract_id = c.Id");
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

        // grid filtering conditions
        $query->andFilterWhere([
            'HasVat' => $this->HasVat,
            'ContractDate' => $this->ContractDate,
            'ContractExpireDate' => $this->ContractExpireDate,
            'status' => $this->status,
            'type' => $this->type,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'Id', $this->Id])
            ->andFilterWhere(['like', 'ContractName', $this->ContractName])
            ->andFilterWhere(['like', 'ContractNo', $this->ContractNo])
            ->andFilterWhere(['like', 'ContractPlace', $this->ContractPlace])
            ->andFilterWhere(['like', 'Tin', $this->Tin])
            ->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'WorkPhone', $this->WorkPhone])
            ->andFilterWhere(['like', 'Mobile', $this->Mobile])
            ->andFilterWhere(['like', 'Fax', $this->Fax])
            ->andFilterWhere(['like', 'Oked', $this->Oked])
            ->andFilterWhere(['like', 'Account', $this->Account])
            ->andFilterWhere(['like', 'BankId', $this->BankId])
            ->andFilterWhere(['like', 'FizTin', $this->FizTin])
            ->andFilterWhere(['like', 'Fio', $this->Fio])
            ->andFilterWhere(['like', 'BranchCode', $this->BranchCode])
            ->andFilterWhere(['like', 'BranchName', $this->BranchName])
            ->andFilterWhere(['like', 'json_items', $this->json_items])
            ->andFilterWhere(['like', 'clients', $this->clients])
            ->andFilterWhere(['like', 'parts', $this->parts]);

        return $dataProvider;
    }
}
