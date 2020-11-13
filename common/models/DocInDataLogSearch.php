<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DocInDataLog;

/**
 * DocInDataLogSearch represents the model behind the search form about `common\models\DocInDataLog`.
 */
class DocInDataLogSearch extends DocInDataLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doc_data_id', 'success_type', 'reason_msg', 'status', 'enabled'], 'integer'],
            [['created_date'], 'safe'],
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
        $query = DocInDataLog::find();

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
            'doc_data_id' => $this->doc_data_id,
            'success_type' => $this->success_type,
            'reason_msg' => $this->reason_msg,
            'created_date' => $this->created_date,
            'status' => $this->status,
            'enabled' => $this->enabled,
        ]);

        return $dataProvider;
    }
}
