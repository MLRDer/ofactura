<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AlcoFormHelper;

/**
 * AlcoFormHelperSearch represents the model behind the search form about `common\models\AlcoFormHelper`.
 */
class AlcoFormHelperSearch extends AlcoFormHelper
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'form_items_id', 'form_id'], 'integer'],
            [['name_uz', 'name_ru'], 'safe'],
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
        $query = AlcoFormHelper::find();

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
            'form_items_id' => $this->form_items_id,
            'form_id' => $this->form_id,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru]);

        return $dataProvider;
    }
}
