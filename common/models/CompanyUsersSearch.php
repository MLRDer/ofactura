<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompanyUsers;

/**
 * CompanyUsersSearch represents the model behind the search form about `common\models\CompanyUsers`.
 */
class CompanyUsersSearch extends CompanyUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'users_id', 'enabled', 'status'], 'integer'],
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
        $query = CompanyUsers::find();
        $query->select("cu.*, u.fio")
            ->from(CompanyUsers::tableName().' cu')
            ->innerJoin(Users::tableName().' u','u.id = cu.users_id');
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
            'users_id' => $this->users_id,
            'enabled' => $this->enabled,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
