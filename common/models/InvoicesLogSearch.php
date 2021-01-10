<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\InvoicesLog;

/**
 * InvoicesLogSearch represents the model behind the search form about `common\models\InvoicesLog`.
 */
class InvoicesLogSearch extends InvoicesLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'succes_type', 'status', 'enabled'], 'integer'],
            [['reason', 'created_date'], 'safe'],
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
        $query = InvoicesLog::find();

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
            'succes_type' => $this->succes_type,
            'created_date' => $this->created_date,
            'status' => $this->status,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
