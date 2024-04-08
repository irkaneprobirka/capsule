<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "age".
 *
 * @property int $id
 * @property string $title
 *
 * @property Description[] $descriptions
 */
class Age extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'age';
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
     * Gets query for [[Descriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDescriptions()
    {
        return $this->hasMany(Description::class, ['age_id' => 'id']);
    }

    public static function getAge(){
        return ( new Query())
        ->select('title')
        ->from('age')
        ->indexBy('id')
        ->column()
        ;
    }
}
