<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReestrMain;

/**
 * ReestrMainSearch represents the model behind the search form of `common\models\ReestrMain`.
 */
class ReestrMainSearch extends ReestrMain
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'created_user'], 'integer'],
            [['reest_no', 'reestr_date', 'created_date'], 'safe'],
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
        $query = ReestrMain::find();

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
            'reestr_date' => $this->reestr_date,
            'created_date' => $this->created_date,
            'created_user' => $this->created_user,
        ]);

        $query->andFilterWhere(['like', 'reest_no', $this->reest_no]);

        return $dataProvider;
    }
}
