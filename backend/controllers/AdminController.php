<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author aafetsrom
 */
namespace backend\controllers;

use dektrium\user\controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController {
    //put your code here
    
   public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'confirm' => ['post'],
                    'delete-tokens' => ['post'],
                    'block' => ['post']
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'block', 'confirm', 'delete-tokens'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return in_array(\Yii::$app->user->identity->username, $this->module->admins);
                        }
                    ],
                ]
            ]
        ];
    }
}
