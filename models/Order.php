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
            [['user_id', 'stylist_id', 'status_id', 'cost'], 'required'],
            [['user_id', 'stylist_id', 'look_id', 'status_id', 'cost'], 'integer'],
            [['created_at'], 'safe'],
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
            'user_id' => 'User ID',
            'stylist_id' => 'Stylist ID',
            'look_id' => 'Look ID',
            'status_id' => 'Status ID',
            'cost' => 'Cost',
            'created_at' => 'Created At',
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
