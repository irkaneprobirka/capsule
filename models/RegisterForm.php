<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

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
class RegisterForm extends Model
{
    public $imageFile;
    public string $name = '';
    public string $surname = '';
    public string $patronymic = '';
    public string $login = '';
    public string $email = '';
    public string $password = '';
    public string $password_repeat = '';
    public string $phone = '';
    public string $image_profile = '';
    public bool $rules = false;


    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'phone', 'password'], 'required'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'phone', 'password'], 'string', 'max' => 255],
            [['login'], 'unique', 'targetClass' => User::class],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}(\-\d{2}){2}$/'],
            ['name', 'match', 'pattern' => '/^[а-яёА-ЯЁ]+$/u'],
            ['surname', 'match', 'pattern' => '/^[а-яёА-ЯЁ]+$/u'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/'],
            ['password', 'string', 'min' => 8, ],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['rules', 'required', 'requiredValue' => 1, 'message' => 'Соглашение с правилами - должно быть отмечено'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Email',
            'phone' => 'Телефон',
            'image_profile' => 'Изображение профиля',
            'password' => 'Пароль',
            'rules' => 'Соглашение с правилами',
            'password_repeat' => 'Повтор пароля',
            'role_id' => 'Role ID',
            'auth_key' => 'Auth Key',
            'imageFile' => 'Изображение профиля',
        ];
    }

    public function registerUser()
    {
        if ($this->validate(false)) {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->role_id = Role::getRoleId('user');

            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $clientRole = $auth->getRole('client');
                $auth->assign($clientRole, $user->id);
            }else{
                Yii::$app->session->setFlash('danger', 'ошибка регистрации, повторите позднее');
                return VarDumper::dump($user->errors, 10, true);
            }
        }
        return $user ?? false;
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
            $this->image_profile = $fileName;
            return true;
        } else {
            return false;
        }
    }
}
