<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WebMenyu;

/**
 * WebMenyuSearch represents the model behind the search form about `common\models\WebMenyu`.
 */
class WebMenyuSearch extends WebMenyu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'path', 'sort_order', 'enabled'], 'integer'],
            [['name_oz', 'name_ru', 'name_uz', 'icon'], 'safe'],
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
        $query = WebMenyu::find();

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
            'parent_id' => $this->parent_id,
            'path' => $this->path,
            'sort_order' => $this->sort_order,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'name_oz', $this->name_oz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
