<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $login
 * @property string $email
 * @property string $phone
 * @property string $image_profile
 * @property string $password
 * @property int $role_id
 * @property string $auth_key
 *
 * @property Clothes[] $clothes
 * @property LookComment[] $lookComments
 * @property Look[] $looks
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property Role $role
 * @property Stylist[] $stylists
 * @property Test[] $tests
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $rbac_role;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'phone', 'image_profile', 'password','auth_key'], 'required'],
            [['role_id'], 'integer'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'phone', 'image_profile', 'password', 'auth_key'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
            ['rbac_role', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'login' => 'Login',
            'email' => 'Email',
            'phone' => 'Phone',
            'image_profile' => 'Image Profile',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'auth_key' => 'Auth Key',
            'rbac_role' => 'Роль пользователя'
        ];
    }

    /**
     * Gets query for [[Clothes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClothes()
    {
        return $this->hasMany(Clothes::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[LookComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLookComments()
    {
        return $this->hasMany(LookComment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Looks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLooks()
    {
        return $this->hasMany(Look::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Orders0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::class, ['stylist_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[Stylists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStylists()
    {
        return $this->hasMany(Stylist::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Test::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findByUsername($login){
        return static::findOne(['login' => $login]);
    }

    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getIsAdmin(){
        return $this->role_id == Role::getRoleId('admin');
    }

    public function getIsStylist(){
        return $this->role_id == Role::getRoleId('stylist');
    }

    public function makeStylist(){
        return $this->role_id = Role::getRoleId('stylist');
    }

    public static function getLogin(){
        return (new Query())
        ->select('login')
        ->from('user')
        ->indexBy('id')
        ->column()
        ;
    }

    public static function getRoles()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        return array_map(function($el){
            return $el->description;
        }, $roles);

    }

    public function getRoless(){
        $roles = Yii::$app->authManager->getRolesByUser($this->getId());
        return ArrayHelper::getColumn($roles, 'description', false);
    }

    
}
