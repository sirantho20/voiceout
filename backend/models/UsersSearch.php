<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompanyUsers;

/**
 * UsersSearch represents the model behind the search form about `common\models\CompanyUsers`.
 */
class UsersSearch extends CompanyUsers
{
    public function rules()
    {
        return [
            [['id', 'company_id'], 'integer'],
            [['user_id', 'username', 'first_name', 'last_name', 'email_address', 'role', 'date_added', 'date_updated', 'password', 'last_login', 'password_reset_token', 'status'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CompanyUsers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_added' => $this->date_added,
            'date_updated' => $this->date_updated,
            'company_id' => $this->company_id,
            'last_login' => $this->last_login,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
