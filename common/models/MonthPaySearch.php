<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MonthPay;

/**
 * MonthPaySearch represents the model behind the search form about `common\models\MonthPay`.
 */
class MonthPaySearch extends MonthPay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'value', 'enabled', 'tarif_id'], 'integer'],
            [['created_date', 'end_date'], 'safe'],
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
        $query = MonthPay::find();

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
            'value' => $this->value,
            'created_date' => $this->created_date,
            'end_date' => $this->end_date,
            'enabled' => $this->enabled,
            'tarif_id' => $this->tarif_id,
        ]);

        return $dataProvider;
    }
}
