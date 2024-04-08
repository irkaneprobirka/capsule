<?php

namespace app\modules\account\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clothes;
use Yii;

/**
 * ClothesSearch represents the model behind the search form of `app\models\Clothes`.
 */
class ClothesSearch extends Clothes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_clothes_id', 'cost', 'description_id'], 'integer'],
            [['title', 'image_clothes', 'created_at', 'brand'], 'safe'],
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
        $query = Clothes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'user_id' => Yii::$app->user->identity->id,
            'category_clothes_id' => $this->category_clothes_id,
            'created_at' => $this->created_at,
            'cost' => $this->cost,
            'description_id' => $this->description_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image_clothes', $this->image_clothes])
            ->andFilterWhere(['like', 'brand', $this->brand]);

        return $dataProvider;
    }
}
