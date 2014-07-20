<?php

namespace frontend\controllers;

use Yii;
use app\models\Complaint;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use app\models\Pictures;

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
            echo Json::encode(ActiveForm::validate($model));
            Yii::$app->end();
        }
    }
    protected function save($model)
    {
        if ($model->validate())
        {   
            /*
            * Prepare picture for upload
            */
           $fileName = '';
           $uploadedFile=UploadedFile::getInstance($model,'photo');
           if($uploadedFile != null){
               $rnd = rand(0,9999);
               //$extension = explode('.', $uploadedFile->name);
               //$ext = $extension[count($extension)-1];
               $ext = $uploadedFile->extension;
               $fileName = $model->complaint_id."_".$model->company_id."{$rnd}".time().".".$ext;  // company id+random number+timestamp+extension
               $model->photo = $fileName;
               $model->has_picture = 'Y';
           }
           
           if ($model->save(false))
           {
                if ($fileName != '')
                {
                    /*
                     * Create a record in picture table
                     */
                    $photoModel = new Pictures();
                    $photoModel->complaint_id = $model->complaint_id;
                    $photoModel->link = $model->photo;
                    $photoModel->save(false);
                    /*
                     * Upload picture file to server
                     */
                    $uploadedFile->saveAs(Yii::$app->basePath.'/assets/images/complaints/'.$fileName);
                }
                $this->redirect(Url::toRoute('/complaint/'.$model->slug));
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
    
    public function actionAll()
    {
        $model = Complaint::find()->all();
        return $this->render('all',['model'=>$model]);
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
        $slug = \yii\helpers\Html::encode(trim(Yii::$app->request->get('slug')));
        $id = '';
        if (strlen($slug) > 0)
        {
            $id = substr($slug,0,10);
            $id = (int)$id;
        }
        $model = Complaint::find()->where(['complaint_id'=>$id])->one();
        if ($model === null)
            throw new \yii\web\HttpException(404,'The complaint you are looking for does not exist');
        else 
        {
            return $this->render('index',['model'=>$model]);  
        }
        Yii::$app->end();
    }

    public function actionView($id)
    {
       return $this->render('view',['model'=>$complaint]);
    }

}
