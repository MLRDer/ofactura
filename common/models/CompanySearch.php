<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Company;

/**
 * CompanySearch represents the model behind the search form about `common\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'tin', 'ns10_code', 'ns11_code', 'status', 'type', 'enabled',"invoices_sum","tarif_id","is_aferta","is_online","count_login"], 'integer'],
            [['name', 'address', 'phone',"district_id"], 'safe'],
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
        $query = Company::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $query->orderBy("id DESC");

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'tin' => $this->tin,
            'count_login' => $this->count_login,
            'is_aferta' => $this->is_aferta,
            'is_online' => $this->is_online,
            'tarif_id' => $this->tarif_id,
            'ns10_code' => $this->ns10_code,
            'ns11_code' => $this->ns11_code,
            'status' => $this->status,

            'invoices_sum' => $this->invoices_sum,
            'type' => $this->type,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }

    public function searchForReport($params)
    {
        $query = Company::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->orderBy("id DESC");
        $query->select("c.* , d.name_uz as reg_name, dd.district_id, dd.name_uz as distric_name")
            ->from(\common\models\Company::tableName().' c')
            ->leftJoin(Districts::tableName().' d','c.ns10_code = d.region_id')
            ->leftJoin(Districts::tableName().' dd','c.ns11_code = dd.ditrict_code and c.ns10_code = dd.region_id')
            ->where("d.parent_region_id is null");

//        $query->orderBy("id DESC");

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'tin' => $this->tin,
            'count_login' => $this->count_login,
            'is_aferta' => $this->is_aferta,
            'is_online' => $this->is_online,
            'tarif_id' => $this->tarif_id,
            'dd.district_id' => $this->district_id,
            'ns10_code' => $this->ns10_code,
            'ns11_code' => $this->ns11_code,
            'status' => $this->status,
            'invoices_sum' => $this->invoices_sum,
            'type' => $this->type,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
