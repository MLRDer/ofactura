<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Invoices;

/**
 * InvoicesItemsSearch represents the model behind the search form about `common\models\Invoices`.
 */
class InvoicesItemsSearch extends Invoices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'type_invoices', 'value', 'tarif_id', 'type_pay', 'status', 'enabled'], 'integer'],
            [['created_date',"company_name"], 'safe'],
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
        $query = Invoices::find();

        $query->select("i.*, c.name company_name")
            ->from(Invoices::tableName()." i")
            ->innerJoin(Company::tableName()." c","c.id=i.company_id");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>false
        ]);

        $query->orderBy('id DESC');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'type_invoices' => $this->type_invoices,
            'created_date' => $this->created_date,
            'value' => $this->value,
            'tarif_id' => $this->tarif_id,
            'type_pay' => $this->type_pay,
            'status' => $this->status,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'c.name', $this->company_name]);

        return $dataProvider;
    }
}
