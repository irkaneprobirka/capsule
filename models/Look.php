<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "look".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $like
 * @property int $dislike
 * @property int $cost
 * @property int $user_id
 * @property string $created_at
 * @property int $description_id
 *
 * @property Description $description0
 * @property LookComment[] $lookComments
 * @property LookItem[] $lookItems
 * @property Order[] $orders
 * @property User $user
 */
class Look extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'look';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'like', 'dislike', 'cost', 'user_id', 'description_id'], 'required'],
            [['like', 'dislike', 'cost', 'user_id', 'description_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['description_id'], 'exist', 'skipOnError' => true, 'targetClass' => Description::class, 'targetAttribute' => ['description_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'like' => 'Like',
            'dislike' => 'Dislike',
            'cost' => 'Cost',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'description_id' => 'Description ID',
        ];
    }

    /**
     * Gets query for [[Description0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDescription0()
    {
        return $this->hasOne(Description::class, ['id' => 'description_id']);
    }

    /**
     * Gets query for [[LookComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLookComments()
    {
        return $this->hasMany(LookComment::class, ['look_id' => 'id']);
    }

    /**
     * Gets query for [[LookItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLookItems()
    {
        return $this->hasMany(LookItem::class, ['look_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['look_id' => 'id']);
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