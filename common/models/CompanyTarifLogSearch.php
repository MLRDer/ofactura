<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompanyTarifLog;

/**
 * CompanyTarifLogSearch represents the model behind the search form about `common\models\CompanyTarifLog`.
 */
class CompanyTarifLogSearch extends CompanyTarifLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'tarif_id', 'send_value', 'remain_value', 'status', 'enabled'], 'integer'],
            [['created_date', 'change_date'], 'safe'],
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
        $query = CompanyTarifLog::find();

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
            'company_id' => $this->company_id,
            'tarif_id' => $this->tarif_id,
            'created_date' => $this->created_date,
            'change_date' => $this->change_date,
            'send_value' => $this->send_value,
            'remain_value' => $this->remain_value,
            'status' => $this->status,
            'enabled' => $this->enabled,
        ]);

        return $dataProvider;
    }
}
