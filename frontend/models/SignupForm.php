<?php
namespace frontend\models;

use common\models\Company;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\Json;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $fio;
    public $tin;
    public $company_name;
    public $address;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['fio', 'required'],
            ['fio', 'string', 'min' => 2, 'max' => 255],

            ['company_name', 'required'],
            ['company_name', 'string', 'min' => 2, 'max' => 255],

            ['tin', 'required'],
            ['tin', 'string', 'min' => 9, 'max' => 9],

            ['address', 'required'],
            ['address', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $reason="";

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->fio = $this->fio;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if(!$user->save()){
            $reason = Json::encode($user->getErrors());
        }
        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
