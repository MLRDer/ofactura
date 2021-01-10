<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Docs;

/**
 * DocsSearch represents the model behind the search form of `common\models\Docs`.
 */
class DocsSearch extends Docs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'AgentTin', 'SellerTin', 'SellerMobile', 'SellerWorkPhone', 'SellerOked', 'SellerDistrictId', 'BuyerTin', 'BuyerMobile', 'BuyerWorkPhone', 'BuyerOked', 'BuyerDistrictId', 'status', 'enabled', 'user_id','type_doc'], 'integer'],
            [['FacturaNo', 'FacturaDate', 'ContractNo', 'ContractDate', 'EmpowermentNo', 'EmpowermentDateOfIssue', 'AgentFio', 'ItemReleasedFio', 'SellerName', 'SellerAccount', 'SellerBankId', 'SellerAddress', 'SellerDirector', 'SellerAccountant', 'SellerVatRegCode', 'BuyerName', 'BuyerAccount', 'BuyerBankId', 'BuyerAddress', 'BuyerDirector', 'BuyerAccountant', 'BuyerVatRegCode', 'docs_pks7', 'json_data', 'json_items', 'created_date', 'send_date', 'accepted_date','FacturaId','name'], 'safe'],
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

    public function searchToAdmin($params)
    {
        $query = Docs::find();

        $query->select("d.*, c.name")
            ->from(\common\models\Docs::tableName()." d")
            ->innerJoin(Company::tableName()." c","c.id=d.company_id");
        // add conditions that should always apply here

        $query->orderBy("id DESC");

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
            'id' => $this->id,
            'company_id' => $this->company_id,
            'type_doc' => $this->type_doc,
            'FacturaDate' => $this->FacturaDate,
            'ContractDate' => $this->ContractDate,
            'EmpowermentDateOfIssue' => $this->EmpowermentDateOfIssue,
            'AgentTin' => $this->AgentTin,
            'SellerTin' => $this->SellerTin,
            'SellerMobile' => $this->SellerMobile,
            'SellerWorkPhone' => $this->SellerWorkPhone,
            'SellerOked' => $this->SellerOked,
            'SellerDistrictId' => $this->SellerDistrictId,
            'BuyerTin' => $this->BuyerTin,
            'BuyerMobile' => $this->BuyerMobile,
            'BuyerWorkPhone' => $this->BuyerWorkPhone,
            'BuyerOked' => $this->BuyerOked,
            'BuyerDistrictId' => $this->BuyerDistrictId,
            'created_date' => $this->created_date,
            'send_date' => $this->send_date,
            'accepted_date' => $this->accepted_date,
            'status' => $this->status,
            'enabled' => $this->enabled,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'FacturaNo', $this->FacturaNo])
            ->andFilterWhere(['like', 'c.name', $this->name])
            ->andFilterWhere(['like', 'ContractNo', $this->ContractNo])
            ->andFilterWhere(['like', 'FacturaId', $this->FacturaId])
            ->andFilterWhere(['like', 'EmpowermentNo', $this->EmpowermentNo])
            ->andFilterWhere(['like', 'AgentFio', $this->AgentFio])
            ->andFilterWhere(['like', 'ItemReleasedFio', $this->ItemReleasedFio])
            ->andFilterWhere(['like', 'SellerName', $this->SellerName])
            ->andFilterWhere(['like', 'SellerAccount', $this->SellerAccount])
            ->andFilterWhere(['like', 'SellerBankId', $this->SellerBankId])
            ->andFilterWhere(['like', 'SellerAddress', $this->SellerAddress])
            ->andFilterWhere(['like', 'SellerDirector', $this->SellerDirector])
            ->andFilterWhere(['like', 'SellerAccountant', $this->SellerAccountant])
            ->andFilterWhere(['like', 'SellerVatRegCode', $this->SellerVatRegCode])
            ->andFilterWhere(['like', 'BuyerName', $this->BuyerName])
            ->andFilterWhere(['like', 'BuyerAccount', $this->BuyerAccount])
            ->andFilterWhere(['like', 'BuyerBankId', $this->BuyerBankId])
            ->andFilterWhere(['like', 'BuyerAddress', $this->BuyerAddress])
            ->andFilterWhere(['like', 'BuyerDirector', $this->BuyerDirector])
            ->andFilterWhere(['like', 'BuyerAccountant', $this->BuyerAccountant])
            ->andFilterWhere(['like', 'BuyerVatRegCode', $this->BuyerVatRegCode])
            ->andFilterWhere(['like', 'docs_pks7', $this->docs_pks7])
            ->andFilterWhere(['like', 'json_data', $this->json_data])
            ->andFilterWhere(['like', 'json_items', $this->json_items]);

        return $dataProvider;
    }
    public function search($params)
    {
        $query = Docs::find();
        $limit = \Yii::$app->request->get('limit',10);
        // add conditions that should always apply here
        if($limit>100)
            $limit=1;
        $query->orderBy("created_date DESC");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'FacturaDate' => $this->FacturaDate,
            'ContractDate' => $this->ContractDate,
            'EmpowermentDateOfIssue' => $this->EmpowermentDateOfIssue,
            'AgentTin' => $this->AgentTin,
            'SellerTin' => $this->SellerTin,
            'SellerMobile' => $this->SellerMobile,
            'SellerWorkPhone' => $this->SellerWorkPhone,
            'SellerOked' => $this->SellerOked,
            'SellerDistrictId' => $this->SellerDistrictId,
            'BuyerTin' => $this->BuyerTin,
            'BuyerMobile' => $this->BuyerMobile,
            'BuyerWorkPhone' => $this->BuyerWorkPhone,
            'BuyerOked' => $this->BuyerOked,
            'BuyerDistrictId' => $this->BuyerDistrictId,
            'created_date' => $this->created_date,
            'send_date' => $this->send_date,
            'accepted_date' => $this->accepted_date,
            'status' => $this->status,
            'enabled' => $this->enabled,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'FacturaNo', $this->FacturaNo])
            ->andFilterWhere(['like', 'ContractNo', $this->ContractNo])
            ->andFilterWhere(['like', 'EmpowermentNo', $this->EmpowermentNo])
            ->andFilterWhere(['like', 'AgentFio', $this->AgentFio])
            ->andFilterWhere(['like', 'ItemReleasedFio', $this->ItemReleasedFio])
            ->andFilterWhere(['like', 'SellerName', $this->SellerName])
            ->andFilterWhere(['like', 'SellerAccount', $this->SellerAccount])
            ->andFilterWhere(['like', 'SellerBankId', $this->SellerBankId])
            ->andFilterWhere(['like', 'SellerAddress', $this->SellerAddress])
            ->andFilterWhere(['like', 'SellerDirector', $this->SellerDirector])
            ->andFilterWhere(['like', 'SellerAccountant', $this->SellerAccountant])
            ->andFilterWhere(['like', 'SellerVatRegCode', $this->SellerVatRegCode])
            ->andFilterWhere(['like', 'BuyerName', $this->BuyerName])
            ->andFilterWhere(['like', 'BuyerAccount', $this->BuyerAccount])
            ->andFilterWhere(['like', 'BuyerBankId', $this->BuyerBankId])
            ->andFilterWhere(['like', 'BuyerAddress', $this->BuyerAddress])
            ->andFilterWhere(['like', 'BuyerDirector', $this->BuyerDirector])
            ->andFilterWhere(['like', 'BuyerAccountant', $this->BuyerAccountant])
            ->andFilterWhere(['like', 'BuyerVatRegCode', $this->BuyerVatRegCode])
            ->andFilterWhere(['like', 'docs_pks7', $this->docs_pks7])
            ->andFilterWhere(['like', 'json_data', $this->json_data])
            ->andFilterWhere(['like', 'json_items', $this->json_items]);

        return $dataProvider;
    }
}
