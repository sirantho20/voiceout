<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Complaint;

/**
 * ComplaintSearch represents the model behind the search form about `app\models\Complaint`.
 */
class ComplaintSearch extends Complaint
{
    public function rules()
    {
        return [
            [['id', 'rating'], 'integer'],
            [['complaint_id', 'company_id', 'user_id', 'cookie_id', 'complaint', 'hashtag', 'is_private', 'date_added', 'date_updated', 'published', 'has_picture', 'has_audio', 'location', 'slug'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Complaint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'rating' => $this->rating,
            'date_added' => $this->date_added,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'complaint_id', $this->complaint_id])
            ->andFilterWhere(['like', 'company_id', $this->company_id])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'cookie_id', $this->cookie_id])
            ->andFilterWhere(['like', 'complaint', $this->complaint])
            ->andFilterWhere(['like', 'hashtag', $this->hashtag])
            ->andFilterWhere(['like', 'is_private', $this->is_private])
            ->andFilterWhere(['like', 'published', $this->published])
            ->andFilterWhere(['like', 'has_picture', $this->has_picture])
            ->andFilterWhere(['like', 'has_audio', $this->has_audio])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
