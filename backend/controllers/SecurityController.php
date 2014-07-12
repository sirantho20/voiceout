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
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SecurityController extends SC {
    //put your code here
    public $enableCsrfValidation = false;
    
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'auth'],
                        'roles' => ['?']
                    ],
                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['logout'],
//                        'roles' => ['@']
//                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }
    
    public function actionLogin()
    {
        $model = $this->module->manager->createLoginForm();

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
           //$this->redirect(\Yii::$app->urlManager->createAbsoluteUrl(['backend/company/index']));
           return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }
}
