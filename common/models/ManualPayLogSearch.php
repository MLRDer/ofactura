<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ManualPayLog;

/**
 * ManualPayLogSearch represents the model behind the search form about `common\models\ManualPayLog`.
 */
class ManualPayLogSearch extends ManualPayLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'pay_sum', 'company_id', 'type', 'enabled'], 'integer'],
            [['client_ip', 'created_date', 'descriptions'], 'safe'],
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
        $query = ManualPayLog::find();

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
            'user_id' => $this->user_id,
            'created_date' => $this->created_date,
            'pay_sum' => $this->pay_sum,
            'company_id' => $this->company_id,
            'type' => $this->type,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'client_ip', $this->client_ip])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions]);

        return $dataProvider;
    }
}
