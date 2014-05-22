<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyDetails;

/**
 * CompanyDetailsSearch represents the model behind the search form about `backend\models\CompanyDetails`.
 */
class CompanyDetailsSearch extends CompanyDetails
{
    public function rules()
    {
        return [
            [['id', 'country_id'], 'integer'],
            [['company_id', 'email_address', 'phone_number', 'address_line_1', 'address_line_2', 'city', 'logo_pic', 'wallpaper_pic'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CompanyDetails::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
        ]);

        $query->andFilterWhere(['like', 'company_id', $this->company_id])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'address_line_1', $this->address_line_1])
            ->andFilterWhere(['like', 'address_line_2', $this->address_line_2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'logo_pic', $this->logo_pic])
            ->andFilterWhere(['like', 'wallpaper_pic', $this->wallpaper_pic]);

        return $dataProvider;
    }
}
