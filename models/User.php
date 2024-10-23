<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;

    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['password_hash', 'string', 'min' => 6],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Этот логин уже занят.'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user'; // Имя таблицы в базе данных
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return password_verify($password, $this->password_hash);
    }

    /**
     * Сеттинг для пароля (хранение хэша пароля)
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Сохраняем пользователя в БД
     *
     * @return bool whether the saving succeeds
     */
    public function saveUser()
    {
        return $this->save();
    }

    /**
     * Перед сохранением пользователя генерируем authKey и accessToken
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->authKey = Yii::$app->security->generateRandomString();
                $this->accessToken = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
}
