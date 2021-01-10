<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompanyDocs;

/**
 * CompanyDocsSearch represents the model behind the search form of `common\models\CompanyDocs`.
 */
class CompanyDocsSearch extends CompanyDocs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'contract_number', 'company_from_id', 'company_to_id', 'status'], 'integer'],
            [['number_docs', 'name', 'created_date', 'accept_date'], 'safe'],
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
        $query = CompanyDocs::find();

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
            'id' => $this->id,
            'company_id' => $this->company_id,
            'contract_number' => $this->contract_number,
            'company_from_id' => $this->company_from_id,
            'company_to_id' => $this->company_to_id,
            'status' => $this->status,
            'created_date' => $this->created_date,
            'accept_date' => $this->accept_date,
        ]);

        $query->andFilterWhere(['like', 'number_docs', $this->number_docs])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
