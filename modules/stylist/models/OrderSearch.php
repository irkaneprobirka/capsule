<?php

namespace app\modules\stylist\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;
use Yii;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'stylist_id', 'look_id', 'status_id', 'cost'], 'integer'],
            [['created_at', 'wish_client', 'answer_stylist'], 'safe'],
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
        $query = Order::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
            'sort' => [
                'defaultOrder' => [
                    // Сначала сортируем по статусу
                    'status_id' => SORT_ASC,
                ],
                'attributes' => [
                    // Добавляем кастомную сортировку для столбца status_id
                    'status_id' => [
                        'asc' => [
                            // Сначала сортируем по статусу 2, потом 1, потом 3
                            new \yii\db\Expression('CASE WHEN status_id = 2 THEN 0 WHEN status_id = 1 THEN 1 WHEN status_id = 3 THEN 2 ELSE 3 END'),
                            'status_id' => SORT_ASC,
                        ],
                        'desc' => [
                            new \yii\db\Expression('CASE WHEN status_id = 2 THEN 0 WHEN status_id = 1 THEN 1 WHEN status_id = 3 THEN 2 ELSE 3 END'),
                            'status_id' => SORT_DESC,
                        ],
                        'default' => SORT_ASC,
                        'label' => 'Status', // Опциональное имя столбца для сортировки в UI
                    ],
                    // Добавьте здесь другие атрибуты, если необходимо
                ],
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
            'user_id' => $this->user_id,
            'stylist_id' => Yii::$app->user->identity->id,
            'look_id' => $this->look_id,
            'status_id' => $this->status_id,
            'cost' => $this->cost,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'wish_client', $this->wish_client])
            ->andFilterWhere(['like', 'answer_stylist', $this->answer_stylist]);

        return $dataProvider;
    }
}
