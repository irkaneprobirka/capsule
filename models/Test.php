<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property int $user_id
 * @property string $color_hair
 * @property string $color_eyes
 * @property int $tall
 * @property int $weight
 * @property string $figure_type
 *
 * @property User $user
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'color_hair', 'color_eyes', 'tall', 'weight', 'figure_type'], 'required'],
            [['user_id', 'tall', 'weight'], 'integer'],
            [['color_hair', 'color_eyes', 'figure_type'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'color_hair' => 'Color Hair',
            'color_eyes' => 'Color Eyes',
            'tall' => 'Tall',
            'weight' => 'Weight',
            'figure_type' => 'Figure Type',
        ];
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
