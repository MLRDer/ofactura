<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WebServices;

/**
 * WebServicesSearch represents the model behind the search form about `common\models\WebServices`.
 */
class WebServicesSearch extends WebServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort_order', 'enabled'], 'integer'],
            [['name_uz', 'name_oz', 'name_ru', 'anons_uz', 'anons_oz', 'anons_ru', 'icon'], 'safe'],
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
        $query = WebServices::find();

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
            ->andFilterWhere(['like', 'anons_uz', $this->anons_uz])
            ->andFilterWhere(['like', 'anons_oz', $this->anons_oz])
            ->andFilterWhere(['like', 'anons_ru', $this->anons_ru])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
