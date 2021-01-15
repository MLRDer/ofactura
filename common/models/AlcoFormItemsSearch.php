<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AlcoFormItems;

/**
 * AlcoFormItemsSearch represents the model behind the search form about `common\models\AlcoFormItems`.
 */
class AlcoFormItemsSearch extends AlcoFormItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'form_id', 'category_id', 'input_type', 'is_recured', 'sort_order'], 'integer'],
            [['label_uz', 'label_ru', 'placeholder_uz', 'placeholder_ru', 'col_size_class'], 'safe'],
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
        $query = AlcoFormItems::find();

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
            'form_id' => $this->form_id,
            'category_id' => $this->category_id,
            'input_type' => $this->input_type,
            'is_recured' => $this->is_recured,
            'sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'label_uz', $this->label_uz])
            ->andFilterWhere(['like', 'label_ru', $this->label_ru])
            ->andFilterWhere(['like', 'placeholder_uz', $this->placeholder_uz])
            ->andFilterWhere(['like', 'placeholder_ru', $this->placeholder_ru])
            ->andFilterWhere(['like', 'col_size_class', $this->col_size_class]);

        return $dataProvider;
    }
}
