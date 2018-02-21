<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\captcha\Captcha;

/**
 * Signup form
 */
class SignupForm extends Model {
    
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $name;
    public $surname;
    public $verifyCode;
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'email', 'name', 'surname'], 'trim'],
            [['username', 'email', 'name', 'surname'], 'default'],
            [['username', 'name', 'surname'], 'match', 'pattern' => '~^[a-zA-Zа-яА-Я][a-zA-Zа-яА-Я0-9]+$~u', 'message' => 'Поле может содержать только буквы и цифры.'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Этот псевдоним занят.'],
            ['username', 'string', 'min' => 2, 'max' => 32],
            
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Эта почта занята.'],
            
            [['name', 'surname'], 'string', 'min' => 2, 'max' => 32],
            
            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 4],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            
            ['verifyCode', 'captcha', 'skipOnEmpty' => !Captcha::checkRequirements(), 'captchaAction' => 'site/captcha'],
        ];
    }
    
    
    public function attributeLabels() {
        return [
            'username' => 'Псевдоним',
            'email' => 'Почта',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
            'name' => 'Имя',
            'surname' => 'Фамилия',
        ];
    }
    
    /**
     * Signs user up.
     * 
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save(false);
        
        // выдача роли "author"
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('blog@author');
        $auth->assign($authorRole, $user->getId());
        
        return $user;
    }
    
}