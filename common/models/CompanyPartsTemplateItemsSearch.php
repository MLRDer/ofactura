<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompanyPartsTemplateItems;

/**
 * CompanyPartsTemplateItemsSearch represents the model behind the search form of `common\models\CompanyPartsTemplateItems`.
 */
class CompanyPartsTemplateItemsSearch extends CompanyPartsTemplateItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'template_id', 'OrdNo'], 'integer'],
            [['Title', 'Body'], 'safe'],
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
        $query = CompanyPartsTemplateItems::find();

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
            'template_id' => $this->template_id,
            'OrdNo' => $this->OrdNo,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'Body', $this->Body]);

        return $dataProvider;
    }
}
