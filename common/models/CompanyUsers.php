<?php
namespace common\models;
use yii\helpers\Security;


/**
 * This is the model class for table "mup_company_users".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $role
 * @property string $date_added
 * @property string $date_updated
 * @property string $password
 * @property integer $company_id
 * @property string $last_login
 * @property string $password_reset_token
 * @property string $status
 *
 * @property MupCompany $company
 */
class CompanyUsers extends User
{

    /**
    * @inheritdoc
    */
   public static function tableName()
   {
       return 'mup_company_users';
   }
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'username', 'first_name', 'last_name', 'email_address'], 'required'],
            [['date_added', 'date_updated', 'last_login'], 'safe'],
            [['company_id'], 'integer'],
            [['user_id'], 'string', 'max' => 12],
            [['username', 'first_name', 'last_name', 'email_address', 'role', 'status'], 'string', 'max' => 45],
            [['password', 'password_reset_token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email_address' => 'Email Address',
            'role' => 'Role',
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
            'password' => 'Password',
            'company_id' => 'Company ID',
            'last_login' => 'Last Login',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(MupCompany::className(), ['id' => 'company_id']);
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }
    
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }
    
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
        /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Security::validatePassword($password, $this->password_hash);
    }
    
}
