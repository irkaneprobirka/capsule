<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "look_comment".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $comment
 * @property int $user_id
 * @property int $look_id
 *
 * @property Look $look
 * @property LookComment[] $lookComments
 * @property LookComment $parent
 * @property User $user
 */
class LookComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'look_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'comment', 'user_id', 'look_id'], 'required'],
            [['parent_id', 'user_id', 'look_id'], 'integer'],
            [['comment'], 'string'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => LookComment::class, 'targetAttribute' => ['parent_id' => 'id']],
            [['look_id'], 'exist', 'skipOnError' => true, 'targetClass' => Look::class, 'targetAttribute' => ['look_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'comment' => 'Comment',
            'user_id' => 'User ID',
            'look_id' => 'Look ID',
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
     * Gets query for [[LookComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLookComments()
    {
        return $this->hasMany(LookComment::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(LookComment::class, ['id' => 'parent_id']);
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
