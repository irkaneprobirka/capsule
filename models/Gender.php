<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "gender".
 *
 * @property int $id
 * @property string $title
 *
 * @property Description[] $descriptions
 */
class Gender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gender';
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
        return $this->hasMany(Description::class, ['gender_id' => 'id']);
    }

    public static function getGender(){
        return ( new Query())
        ->select('title')
        ->from('gender')
        ->indexBy('id')
        ->column()
        ;
    }
}
