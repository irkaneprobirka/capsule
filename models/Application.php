<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property int $category_id
 * @property int $user_id
 * @property int $status_id
 * @property string $created_at
 * @property string|null $reason
 * @property string|null $image_admin
 *
 * @property Category $category
 * @property Status $status
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description','category_id', 'user_id', 'status_id'], 'required'],
            [['category_id', 'user_id', 'status_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'description','reason', 'image_admin'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024*1024*10],
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
            'description' => 'Description',
            'image' => 'Image',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'created_at' => 'Created At',
            'reason' => 'Reason',
            'image_admin' => 'Image Admin',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
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
        $this->image = Yii::$app->security->generateRandomString()
        . 
        '.'
         . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs('img/' . $this->image);
            return true;
        } else {
            return false;
        }
    }
    public function uploadAdmin()
    {
        $this->image_admin = Yii::$app->security->generateRandomString()
        . 
        '.'
         . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs('img/' . $this->image_admin);
            return true;
        } else {
            return false;
        }
    }
}

