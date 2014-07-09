<?php
namespace frontend\models;

use common\models\CompanyUsers;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email_address;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email_address', 'filter', 'filter' => 'trim'],
            ['email_address', 'required'],
            ['email_address', 'email'],
            ['email_address', 'exist',
                'targetClass' => '\common\models\CompanyUsers',
                'filter' => ['status' => CompanyUsers::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /** @var User $user */
        $user = CompanyUsers::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $user->generatePasswordResetToken();
            if ($user->save()) {
                return \Yii::$app->mail->compose('passwordResetToken', ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
}
