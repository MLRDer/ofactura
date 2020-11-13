<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WebFeedBack;

/**
 * WebFeedBackSearch represents the model behind the search form about `common\models\WebFeedBack`.
 */
class WebFeedBackSearch extends WebFeedBack
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort_order', 'enabled'], 'integer'],
            [['name_uz', 'name_oz', 'name_ru', 'body_uz', 'body_oz', 'body_ru'], 'safe'],
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
        $query = WebFeedBack::find();

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
            'sort_order' => $this->sort_order,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_oz', $this->name_oz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'body_uz', $this->body_uz])
            ->andFilterWhere(['like', 'body_oz', $this->body_oz])
            ->andFilterWhere(['like', 'body_ru', $this->body_ru]);

        return $dataProvider;
    }
}
