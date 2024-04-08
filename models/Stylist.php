<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stylist".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_stylist_id
 *
 * @property CategoryStylist $categoryStylist
 * @property User $user
 */
class Stylist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stylist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_stylist_id'], 'required'],
            [['user_id', 'category_stylist_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['category_stylist_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryStylist::class, 'targetAttribute' => ['category_stylist_id' => 'id']],
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
            'category_stylist_id' => 'Category Stylist ID',
        ];
    }

    /**
     * Gets query for [[CategoryStylist]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryStylist()
    {
        return $this->hasOne(CategoryStylist::class, ['id' => 'category_stylist_id']);
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
