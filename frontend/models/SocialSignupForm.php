<?php

namespace frontend\models;



use Yii;

use yii\base\Model;

use common\models\SocialUser;



/**

 * Signup form

 */

class SocialSignupForm extends Model

{

    public $username;

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



            ['email', 'trim'],

            ['email', 'required'],

            ['email', 'string'],

            ['email', 'string', 'max' => 255],

            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This id address has already been taken.'],



            ['password', 'required'],

            ['password', 'string', 'min' => 6],

            [['agree'],'safe'],

			

        ];

    }

    /**

     * {@inheritdoc}

     */

    public function attributeLabels()

    {

        return [

            'confirm_knowledge' => 'All the information entered by me in the registration form is true to the best of my knowledge.',

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

        

        $user = new SocialUser();

        $user->username = $this->username;

        $user->email = $this->email;

        $user->setPassword($this->password);

        $user->generateAuthKey();

        $user->generateEmailVerificationToken();

		if($user->save()) {

			\Yii::$app->user->switchIdentity($user);

			//$this->sendEmail($user);

			return true;

		} else {

			return false;

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

