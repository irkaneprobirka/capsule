<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "look_item".
 *
 * @property int $id
 * @property int $look_id
 * @property int $clothes_id
 *
 * @property Clothes $clothes
 * @property Look $look
 */
class LookItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'look_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['look_id', 'clothes_id'], 'required'],
            [['look_id', 'clothes_id'], 'integer'],
            [['clothes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clothes::class, 'targetAttribute' => ['clothes_id' => 'id']],
            [['look_id'], 'exist', 'skipOnError' => true, 'targetClass' => Look::class, 'targetAttribute' => ['look_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'look_id' => 'Look ID',
            'clothes_id' => 'Clothes ID',
        ];
    }

    /**
     * Gets query for [[Clothes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClothes()
    {
        return $this->hasOne(Clothes::class, ['id' => 'clothes_id']);
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
}
