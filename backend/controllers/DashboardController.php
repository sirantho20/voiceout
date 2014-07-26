<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardController
 *
 * @author aafetsrom
 */
namespace backend\controllers;
use yii\web\Controller;

class DashboardController extends Controller {
    //put your code here
    
    public $layout = '/adminMain';
    
    public function actionIndex()
    {
        return $this->render('super/index');
    }
}
