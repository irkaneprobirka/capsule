<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $stylist_id
 * @property int|null $look_id
 * @property int $status_id
 * @property int $cost
 * @property string $created_at
 * @property string $wish_client
 * @property string|null $answer_stylist
 *
 * @property Look $look
 * @property Status $status
 * @property User $stylist
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'stylist_id', 'cost', 'wish_client'], 'required'],
            [['user_id', 'stylist_id', 'look_id', 'status_id', 'cost'], 'integer'],
            [['created_at'], 'safe'],
            [['wish_client', 'answer_stylist'], 'string'],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['look_id'], 'exist', 'skipOnError' => true, 'targetClass' => Look::class, 'targetAttribute' => ['look_id' => 'id']],
            [['stylist_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['stylist_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Логин пользователя',
            'stylist_id' => 'Стилист',
            'look_id' => 'Образ',
            'status_id' => 'Статус',
            'cost' => 'Стоимость',
            'created_at' => 'Время создания',
            'wish_client' => 'Пожелания клиента',
            'answer_stylist' => 'Обратная связь',
        ];
    }

    /**
     * Gets query for [[Look]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLook()
    {
        return $this->hasOne(Look::class, ['id' => 'look_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Stylist]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStylist()
    {
        return $this->hasOne(User::class, ['id' => 'stylist_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
