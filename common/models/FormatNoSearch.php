<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FormatNo;

/**
 * FormatNoSearch represents the model behind the search form of `common\models\FormatNo`.
 */
class FormatNoSearch extends FormatNo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_doc', 'number', 'enabled'], 'integer'],
            [['tin', 'after_number', 'before_number', 'update_date'], 'safe'],
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
        $query = FormatNo::find();

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
            'type_doc' => $this->type_doc,
            'number' => $this->number,
            'update_date' => $this->update_date,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'after_number', $this->after_number])
            ->andFilterWhere(['like', 'before_number', $this->before_number]);

        return $dataProvider;
    }
}
