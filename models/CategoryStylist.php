<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "category_stylist".
 *
 * @property int $id
 * @property string $title
 * @property int $cost
 *
 * @property Stylist[] $stylists
 */
class CategoryStylist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_stylist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'cost'], 'required'],
            [['cost'], 'integer'],
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
            'cost' => 'Cost',
        ];
    }

    /**
     * Gets query for [[Stylists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStylists()
    {
        return $this->hasMany(Stylist::class, ['category_stylist_id' => 'id']);
    }

    public static function getStylistCategory()
    {
        return (new Query())
            ->select('title')
            ->from('category_stylist')
            ->indexBy('id')
            ->column();
    }
}
