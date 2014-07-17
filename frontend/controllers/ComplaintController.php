<?php

namespace frontend\controllers;

use Yii;
use app\models\Complaint;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class ComplaintController extends \yii\web\Controller
{
    public function actionNew()
    {
        $model = new Complaint;
        if ($model->load(Yii::$app->request->post()))
        {
            $this->performAjaxValidation($model);
            $this->save($model);
        }
        else
        {
            return $this->render('new');
        }
    }
    
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='complaint-form')
        {
            echo json_encode(ActiveForm::validate($model));
            Yii::$app->end();
        }
    }
    protected function save($model)
    {
        if ($model->validate())
        {/*
            * Prepare picture for upload
            */
           $fileName = '';
           $uploadedFile=UploadedFile::getInstance($model,'photo');
           if($uploadedFile != null){
               $rnd = rand(0,9999);
               $extension = explode('.', $uploadedFile->name);
               $ext = $extension[count($extension)-1];
               $fileName = $model->complaint_id."_".$model->company_id."{$rnd}".time().".".$ext;  // company id+random number+timestamp+extension
               $model->photo = $fileName;
               $model->has_image = 'Y';
           }

           if ($model->save(false))
           {
                if ($fileName != '')
                {
                    /*
                     * Create a record in picture table
                     */
                    $photoModel = new Pictures();
                    $photoModel->complaint_id = $model->company_id;
                    $photoModel->link = $model->photo;

                    /*
                     * Upload picture file to server
                     */
                    $uploadedFile->saveAs(Yii::$app->basePath.'/../images/complaint_images/'.$fileName);
                }
                $this->redirect(Yii::$app->controller->createUrl('complaint/view'));
                Yii::$app->end();
           }
           else
           {
                Yii::app()->user->setFlash('new-complaint-failure','Failed to create complaint. Try again');
                $this->redirect(Yii::$app->user->returnUrl);
                Yii::$app->end();
           }
        }
        
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
