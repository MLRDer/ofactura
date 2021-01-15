<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BankInvoicesLog;

/**
 * BankInvoicesLogSearch represents the model behind the search form of `common\models\BankInvoicesLog`.
 */
class BankInvoicesLogSearch extends BankInvoicesLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'enabled'], 'integer'],
            [['docId', 'docNumb', 'currDay', 'codeFilial', 'clMfo', 'clAcc', 'clInn', 'clName', 'coMfo', 'coAcc', 'coInn', 'coName', 'payPurpose', 'sumPay', 'state', 'operationId'], 'safe'],
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
        $query = BankInvoicesLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->orderBy('id DESC');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'docId', $this->docId])
            ->andFilterWhere(['like', 'docNumb', $this->docNumb])
            ->andFilterWhere(['like', 'currDay', $this->currDay])
            ->andFilterWhere(['like', 'codeFilial', $this->codeFilial])
            ->andFilterWhere(['like', 'clMfo', $this->clMfo])
            ->andFilterWhere(['like', 'clAcc', $this->clAcc])
            ->andFilterWhere(['like', 'clInn', $this->clInn])
            ->andFilterWhere(['like', 'clName', $this->clName])
            ->andFilterWhere(['like', 'coMfo', $this->coMfo])
            ->andFilterWhere(['like', 'coAcc', $this->coAcc])
            ->andFilterWhere(['like', 'coInn', $this->coInn])
            ->andFilterWhere(['like', 'coName', $this->coName])
            ->andFilterWhere(['like', 'payPurpose', $this->payPurpose])
            ->andFilterWhere(['like', 'sumPay', $this->sumPay])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'operationId', $this->operationId]);

        return $dataProvider;
    }
}
