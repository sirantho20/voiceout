<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Company;

/**
 * CompanySearch represents the model behind the search form about `backend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'industry_id', 'category_id', 'license_package'], 'integer'],
            [['company_id', 'company_name', 'date_added', 'date_updated', 'confirmed', 'slug', 'is_registered'], 'safe'],
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

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_added' => $this->date_added,
            'date_updated' => $this->date_updated,
            'industry_id' => $this->industry_id,
            'category_id' => $this->category_id,
            'license_package' => $this->license_package,
        ]);

        $query->andFilterWhere(['like', 'company_id', $this->company_id])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'confirmed', $this->confirmed])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'is_registered', $this->is_registered]);

        return $dataProvider;
    }
}
