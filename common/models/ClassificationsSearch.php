<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Classifications;

/**
 * ClassificationsSearch represents the model behind the search form of `common\models\Classifications`.
 */
class ClassificationsSearch extends Classifications
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enabled'], 'integer'],
            [['tin', 'groupCode', 'classCode', 'className', 'productCode', 'productName'], 'safe'],
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
        $query = Classifications::find();

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
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'groupCode', $this->groupCode])
            ->andFilterWhere(['like', 'classCode', $this->classCode])
            ->andFilterWhere(['like', 'className', $this->className])
            ->andFilterWhere(['like', 'productCode', $this->productCode])
            ->andFilterWhere(['like', 'productName', $this->productName]);

        return $dataProvider;
    }
}
