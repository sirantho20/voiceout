<?php

namespace frontend\controllers;

class ComplaintController extends \yii\web\Controller
{
    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
