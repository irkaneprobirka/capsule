<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "clothes".
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property string $image_clothes
 * @property int $category_clothes_id
 * @property string $created_at
 * @property int $cost
 * @property int $description_id
 * @property string $brand
 *
 * @property CategoryClothes $categoryClothes
 * @property Description $description
 * @property LookItem[] $lookItems
 * @property User $user
 */
class Clothes extends \yii\db\ActiveRecord
{

    public $imageFile;
    public $season;
    public $type;
    public $age;
    public $gender;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clothes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','category_clothes_id', 'cost', 'brand', 'season', 'age', 'type', 'gender'], 'required'],
            [['user_id', 'category_clothes_id', 'cost', 'description_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'brand'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'user_id' => 'User ID',
            'image_clothes' => 'Изображение',
            'category_clothes_id' => 'Категория',
            'created_at' => 'Дата добавления',
            'cost' => 'Стоимость',
            'description_id' => 'Description ID',
            'brand' => 'Бренд',
            'season' => 'Сезон',
            'age' => 'Возраст',
            'type' => 'Тип',
            'gender' => 'Пол',
            'imageFile' => 'Изображение',
        ];
    }

    /**
     * Gets query for [[CategoryClothes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryClothes()
    {
        return $this->hasOne(CategoryClothes::class, ['id' => 'category_clothes_id']);
    }

    /**
     * Gets query for [[Description]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDescription()
    {
        return $this->hasOne(Description::class, ['id' => 'description_id']);
    }

    /**
     * Gets query for [[LookItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLookItems()
    {
        return $this->hasMany(LookItem::class, ['clothes_id' => 'id']);
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

    public function upload()
    {
        if ($this->validate()) {
            $fileName = Yii::$app->security->generateRandomString(10)
                . '_'
                . time()
                . '.'
                . $this->imageFile->extension;
            $this->imageFile->saveAs('img/' . $fileName);
            $this->image_clothes = $fileName;
            return true;
        } else {
            VarDumper::dump($this->image_clothes, 10, true);die;
            return false;
        }
    }
}
