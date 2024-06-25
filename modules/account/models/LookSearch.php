<?php

namespace app\modules\account\models;

use app\models\Description;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Look;
use Yii;

/**
 * LookSearch represents the model behind the search form of `app\models\Look`.
 */
class LookSearch extends Look
{

    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'like', 'dislike', 'cost', 'user_id', 'description_id'], 'integer'],
            [['title', 'description', 'created_at'], 'safe'],
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
        $query = Look::find()->joinWith('description');

        if ($age_id = Yii::$app->request->get('age_id')) {
            $query->andWhere(['description.age_id' => $age_id]);
        }

        if ($gender_id = Yii::$app->request->get('gender_id')) {
            $query->andWhere(['description.gender_id' => $gender_id]);
        }

        if ($season_id = Yii::$app->request->get('season_id')) {
            $query->andWhere(['description.season_id' => $season_id]);
        }

        if ($type_id = Yii::$app->request->get('type_id')) {
            $query->andWhere(['description.type_id' => $type_id]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'like' => $this->like,
            'dislike' => $this->dislike,
            'cost' => $this->cost,
            'user_id' =>  Yii::$app->user->identity->id,
            'created_at' => $this->created_at,
            'description_id' => $this->description_id,
            'is_active' => $this->is_active,
            'age' => $this->age,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
