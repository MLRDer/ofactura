<?php
namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Acts;

/**
 * ActsSearch represents the model behind the search form of `common\models\Acts`.
 */
class ActsSearch extends Acts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'ActNo', 'ActDate', 'ActText', 'ContractNo', 'ContractDate', 'SellerTin', 'SellerName', 'BuyerTin', 'BuyerName', 'ActProductId', 'Tin', 'created_date'], 'safe'],
            [['status', 'type'], 'integer'],
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
        $query = Acts::find();

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
        $query->orderBy('created_date DESC');
        // grid filtering conditions
        $query->andFilterWhere([
            'ActDate' => $this->ActDate,
            'ContractDate' => $this->ContractDate,
            'status' => $this->status,
            'type' => $this->type,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'Id', $this->Id])
            ->andFilterWhere(['like', 'ActNo', $this->ActNo])
            ->andFilterWhere(['like', 'ActText', $this->ActText])
            ->andFilterWhere(['like', 'ContractNo', $this->ContractNo])
            ->andFilterWhere(['like', 'SellerTin', $this->SellerTin])
            ->andFilterWhere(['like', 'SellerName', $this->SellerName])
            ->andFilterWhere(['like', 'BuyerTin', $this->BuyerTin])
            ->andFilterWhere(['like', 'BuyerName', $this->BuyerName])
            ->andFilterWhere(['like', 'ActProductId', $this->ActProductId])
            ->andFilterWhere(['like', 'Tin', $this->Tin]);

        return $dataProvider;
    }
}
