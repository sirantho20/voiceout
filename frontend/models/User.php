<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mup_user".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $date_added
 * @property string $date_updated
 * @property string $password
 *
 * @property MupComment[] $mupComments
 * @property MupComplaint[] $mupComplaints
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'username', 'first_name', 'last_name', 'email_address', 'date_added', 'date_updated'], 'required'],
            [['id'], 'integer'],
            [['date_added', 'date_updated'], 'safe'],
            [['user_id'], 'string', 'max' => 12],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 45],
            [['email_address', 'password'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['username'], 'unique']
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
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupComments()
    {
        return $this->hasMany(MupComment::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupComplaints()
    {
        return $this->hasMany(MupComplaint::className(), ['user_id' => 'user_id']);
    }
}
