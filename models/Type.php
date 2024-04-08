<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "type".
 *
 * @property int $id
 * @property string $title
 *
 * @property Description[] $descriptions
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type';
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
        return $this->hasMany(Description::class, ['type_id' => 'id']);
    }

    public static function getType(){
        return ( new Query())
        ->select('title')
        ->from('type')
        ->indexBy('id')
        ->column()
        ;
    }
}
