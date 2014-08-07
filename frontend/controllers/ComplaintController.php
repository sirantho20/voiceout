<?php

namespace frontend\controllers;

use Yii;
use app\models\Complaint;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use app\models\Pictures;
use app\models\Reply;
use app\models\Escalate;
use app\models\Timeline;
use app\models\ComplaintFollowing;
use yii\data\Pagination;
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
           if(trim($uploadedFile->name) != ''){
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
                Yii::$app->session->setFlash('success','Complaint created successfully. Your complaint will be forwarded for appropriate action');
                $this->redirect(Url::toRoute('/complaint/'.$model->slug));
                Yii::$app->end();
           }
           else
           {
                Yii::$app->session->setFlash('error','Failed to create complaint. Try again');
                $this->redirect(Yii::$app->user->returnUrl);
                Yii::$app->end();
           }
        }
        
    }
    
    public function actionAll()
    {
        $query = Complaint::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>10]);
        $model = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('all',['model'=>$model, 'pages' => $pages,]);
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
        $reply = new Reply;
        $escalate = new Escalate;
        if ($model === null)
            throw new \yii\web\HttpException(404,'The complaint you are looking for does not exist');
        else 
        {
            return $this->render('index',['model'=>$model,'reply'=>$reply,'escalate'=>$escalate]);  
        }
        Yii::$app->end();
    }

    public function actionView($id)
    {
       return $this->render('view',['model'=>$complaint]);
    }
    
    public static function ComplaintList()
    {
        $model = Complaint::find()->orderBy('date_added DESC')->limit(15)->all();
        return $model;
    }
    
    public function actionReply()
    {
        $model = new Reply;
        if ($model->load(Yii::$app->request->post()))
        {
            //$this->performReplyAjaxValidation($model);
            if ($model->validate())
            {
                $timeline = new Timeline;
                $model->save(false);
                $timeline->id = null;
                $timeline->company_id = $model->company_id;
                $timeline->action_type = "R";
                $timeline->complaint_id = $model->complaint_id;
                $timeline->action_id = $model->id;
                $timeline->date_added = new \yii\db\Expression('Now()');
                $timeline->save(false);
                
                Yii::$app->session->setFlash('success', 'Complaint escalated successfully');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Unable to add reply. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
        }
        else
        {
                Yii::$app->session->setFlash('error', 'Unable to add reply. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
        }
        
    }
    
     public function actionEscalate()
    {
        $model = new Escalate;
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate())
            {
                if (\frontend\components\Voh::EscalateUserCounter($model->complaint_id, $model->user_id))
                {
                    Yii::$app->session->setFlash('error', 'You have already escalated this complaint');
                    $this->redirect(Yii::$app->request->referrer);
                    Yii::$app->end();
                }
                $timeline = new Timeline;
                $model->save(false);
                $timeline->id = null;
                $timeline->company_id = $model->company_id;
                $timeline->action_type = "E";
                $timeline->complaint_id = $model->complaint_id;
                $timeline->action_id = $model->id;
                $timeline->date_added = new \yii\db\Expression('Now()');
                $timeline->save(false);
                Yii::$app->session->setFlash('success', 'Complaint escalated successfully');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Unable to escalate this complaint. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
        }
        else
        {
                Yii::$app->session->setFlash('error', 'Unable to escalate this complaint. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
        }
        
    }
    
    public function actionFollow()
    {
        $model = new ComplaintFollowing;
        if (isset($_GET['complaint_id']) && isset($_GET['company_id']))
        {
            $complaint_id = trim(strip_tags($_GET['complaint_id']));
            $company_id = trim(strip_tags($_GET['company_id']));
            $model->complaint_id = $complaint_id;
            if ($model->validate())
            {
                if (\frontend\components\Voh::FollowUserCounter($model->complaint_id, $model->user_id))
                {
                    Yii::$app->session->setFlash('error', 'You are already following this complaint');
                    $this->redirect(Yii::$app->request->referrer);
                    Yii::$app->end();
                }
                $timeline = new Timeline;
                $model->save(false);
                $timeline->id = null;
                $timeline->company_id = $company_id;
                $timeline->action_type = "F";
                $timeline->complaint_id = $model->complaint_id;
                $timeline->action_id = $model->id;
                $timeline->date_added = new \yii\db\Expression('Now()');
                $timeline->save(false);
                Yii::$app->session->setFlash('success', 'You are now following this complaint');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Unable to follow this complaint. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
        }
        else 
        {
                Yii::$app->session->setFlash('error', 'Unable to follow this complaint. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
        }
    }
    
    public function actionUnfollow()
    {
        if (isset($_GET['complaint_id']) && isset($_GET['company_id']))
        {
            $complaint_id = trim(strip_tags($_GET['complaint_id']));
            $company_id = trim(strip_tags($_GET['company_id']));
            //get current user
            $user_id = \frontend\components\Voh::guest_id;
            if (\frontend\components\Voh::FollowUserCounter($complaint_id, $user_id))
            {
                $follow = ComplaintFollowing::find()->where(['complaint_id'=>$complaint_id,'user_id'=>$user_id])->one();
                $timeline = Timeline::find()->where(['action_id'=>$follow->id,'action_type'=>'F'])->one();
                $timeline->delete();
                $follow->delete();
                Yii::$app->session->setFlash('success', 'You are no more following this complaint');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
            
        }
        else 
        {
                Yii::$app->session->setFlash('error', 'Unable to stop following this complaint. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
        }
    }

}
