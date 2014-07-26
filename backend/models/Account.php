<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace backend\models;
use dektrium\user\models\Account as BaseModel;

/**
 * @property integer $id         Id
 * @property integer $user_id    User id, null if account is not bind to user
 * @property string  $provider   Name of service
 * @property string  $client_id  Account id
 * @property string  $properties Account properties returned by social network (json encoded)
 * @property string  $data       Json-decoded properties
 * @property User    $user       User that this account is connected for.
 *
 * @property \dektrium\user\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */

class Account extends BaseModel
{
    
}

