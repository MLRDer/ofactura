<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DocProducts;

/**
 * DocProductsSearch represents the model behind the search form of `common\models\DocProducts`.
 */
class DocProductsSearch extends DocProducts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'doc_id', 'SortOreder', 'ProductMeasureId', 'ProductCount', 'ProductSumma', 'ProductDeliverySum', 'ProductVatRate', 'ProductVatSum', 'ProductDeliverySumWithVat', 'ProductFuelRate', 'ProductFuelSum', 'ProductDeliverySumWithFuel', 'created_date', 'status', 'enabled'], 'integer'],
            [['ProductName'], 'safe'],
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
        $query = DocProducts::find();

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
            'doc_id' => $this->doc_id,
            'SortOreder' => $this->SortOreder,
            'ProductMeasureId' => $this->ProductMeasureId,
            'ProductCount' => $this->ProductCount,
            'ProductSumma' => $this->ProductSumma,
            'ProductDeliverySum' => $this->ProductDeliverySum,
            'ProductVatRate' => $this->ProductVatRate,
            'ProductVatSum' => $this->ProductVatSum,
            'ProductDeliverySumWithVat' => $this->ProductDeliverySumWithVat,
            'ProductFuelRate' => $this->ProductFuelRate,
            'ProductFuelSum' => $this->ProductFuelSum,
            'ProductDeliverySumWithFuel' => $this->ProductDeliverySumWithFuel,
            'created_date' => $this->created_date,
            'status' => $this->status,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'ProductName', $this->ProductName]);

        return $dataProvider;
    }
}
