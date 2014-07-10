<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SecurityController
 *
 * @author aafetsrom
 */
namespace backend\controllers;
use dektrium\user\controllers\SecurityController as SC;

class SecurityController extends SC {
    //put your code here
    public $enableCsrfValidation = false;
}
