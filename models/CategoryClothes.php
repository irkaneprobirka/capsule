<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "category_clothes".
 *
 * @property int $id
 * @property string $title
 *
 * @property Clothes[] $clothes
 */
class CategoryClothes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_clothes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[Clothes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClothes()
    {
        return $this->hasMany(Clothes::class, ['category_clothes_id' => 'id']);
    }

    public static function getCategoryClothes(){
        return ( new Query())
        ->select('title')
        ->from('category_clothes')
        ->indexBy('id')
        ->column()
        ;
    }
}
