<?php

namespace backend\controllers;

use Yii;
use common\models\CompanyUsers;
use app\models\CompanyUsersSearch;
use yii\web\Controller;

class SecureController extends Controller {
    //put your code here
    



    public function actionIndex()
    {
        
    }
    
    public function actionChangePassword()
    {
        $id = 1;
        $model = new \backend\models\passwordChangeForm($id);
        
        if($model->load(Yii::$app->request->post()) && $model->changePassword())
        {
            
        }
        else 
        {
            $this->render('change', [
                'model' => new CompanyUsers(),
            ]);
        }
    }
}
