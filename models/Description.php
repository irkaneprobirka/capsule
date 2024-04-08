<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "description".
 *
 * @property int $id
 * @property int $season_id
 * @property int|null $type_id
 * @property int $age_id
 * @property int $gender_id
 *
 * @property Age $age
 * @property Clothes[] $clothes
 * @property Gender $gender
 * @property Look[] $looks
 * @property Season $season
 * @property Type $type
 */
class Description extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'description';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['season_id', 'age_id', 'gender_id'], 'required'],
            [['season_id', 'type_id', 'age_id', 'gender_id'], 'integer'],
            [['age_id'], 'exist', 'skipOnError' => true, 'targetClass' => Age::class, 'targetAttribute' => ['age_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::class, 'targetAttribute' => ['gender_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
            [['season_id'], 'exist', 'skipOnError' => true, 'targetClass' => Season::class, 'targetAttribute' => ['season_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'season_id' => 'Season ID',
            'type_id' => 'Type ID',
            'age_id' => 'Age ID',
            'gender_id' => 'Gender ID',
        ];
    }

    /**
     * Gets query for [[Age]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAge()
    {
        return $this->hasOne(Age::class, ['id' => 'age_id']);
    }

    /**
     * Gets query for [[Clothes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClothes()
    {
        return $this->hasMany(Clothes::class, ['description_id' => 'id']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::class, ['id' => 'gender_id']);
    }

    /**
     * Gets query for [[Looks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLooks()
    {
        return $this->hasMany(Look::class, ['description_id' => 'id']);
    }

    /**
     * Gets query for [[Season]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeason()
    {
        return $this->hasOne(Season::class, ['id' => 'season_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }
}
