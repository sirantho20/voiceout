<?php

namespace backend\models;
use yii\base\Model;

class passwordChangeForm extends Model {
    
    public $password;
    public $_model;
    public function __construct($id, $config = array()) {
        $this->_model = \common\models\CompanyUsers::findOne($id);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    
    public function changePassword()
    {
        $user = $this->_model;
        $user->password = \yii\helpers\Security::generatePasswordHash($this->password);
        return $user->save(false);
    }
}
