<?php

namespace frontend\controllers;

use Yii;
use app\models\Company;
use app\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use app\models\Complaint;
use app\models\Timeline;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $slug = \yii\helpers\Html::encode(trim(Yii::$app->request->get('slug')));
        $id = '';
        if (strlen($slug) > 0)
        {
            $id = substr($slug,0,12);
            $id = (int)$id;
        }
        $model = Company::find()->where(['company_id'=>$id])->one();
        if ($model === null)
            throw new \yii\web\HttpException(404,'The company you are looking for does not exist');
        else 
        {
            $complaint = Complaint::find()->where(['company_id'=>$id])->all();
            if (Yii::$app->request->isAjax)
               return $this->renderAjax('_complaints',['model'=>$model,'complaint'=>$complaint]);  
            else
                return $this->render('index',['model'=>$model,'complaint'=>$complaint]);  
        }
        Yii::$app->end();
    }
    
    public function actionAll()
    {
        $model = Company::find()->all();
        return $this->render('all',['model'=>$model]);
    }
    
    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNew()
    {
        $model = new Company;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the company to use in the complaint widget. Passed via ajax request
     */
    public function actionGetcompany($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $query->select('company_id As id, company_name AS text')
            ->from('mup_company')
            ->where('company_name LIKE "%' . $search .'%"')
            ->limit(50);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => Company::find($id)->company_name];
        }
        else {
        $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }
    
    public function actionFollow()
    {
        $model = new \app\models\CompanyFollowing;
        if (isset($_GET['id']) && $_GET['id'] != '')
        {
            $company_id = trim(strip_tags($_GET['id']));
            $model->company_id = $company_id;
            if ($model->validate())
            {
                if (\frontend\components\Voh::FollowCompanyUser($model->company_id, $model->user_id))
                {
                    Yii::$app->session->setFlash('error', 'You are already following this company');
                    $this->redirect(Yii::$app->request->referrer);
                    Yii::$app->end();
                }
                $timeline = new Timeline;
                $model->save(false);
                $timeline->id = null;
                $timeline->company_id = $company_id;
                $timeline->action_type = "F";
                $timeline->action_id = $model->id;
                $timeline->date_added = new \yii\db\Expression('Now()');
                $timeline->save(false);
                Yii::$app->session->setFlash('success', 'You are now following this company');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Unable to follow this company. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
            }
        }
        else 
        {
                Yii::$app->session->setFlash('error', 'Unable to follow this company. Please try again');
                $this->redirect(Yii::$app->request->referrer);
                Yii::$app->end();
        }
    }
    
    public function actionFollowers()
    {
  
            $this->renderAjax('followers');
        
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
