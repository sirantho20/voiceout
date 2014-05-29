<?php

namespace backend\models;
use yii\base\Model;

class passwordChangeForm extends Model {
    
    public $password;
    private $_model;

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    
    public function changePassword($id)
    {
        $user = \common\models\CompanyUsers::find($id);
        $user->password = \yii\helpers\Security::generatePasswordHash($this->password);
        if($user->save())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
