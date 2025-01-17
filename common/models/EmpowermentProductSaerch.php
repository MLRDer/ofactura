<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EmpowermentProduct;

/**
 * EmpowermentProductSaerch represents the model behind the search form of `common\models\EmpowermentProduct`.
 */
class EmpowermentProductSaerch extends EmpowermentProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'empowerment_id', 'MeasureId', 'Count', 'enabled'], 'integer'],
            [['Name'], 'safe'],
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
        $query = EmpowermentProduct::find();

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
            'empowerment_id' => $this->empowerment_id,
            'MeasureId' => $this->MeasureId,
            'Count' => $this->Count,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name]);

        return $dataProvider;
    }
}
