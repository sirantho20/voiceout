<?php

namespace backend\controllers;

use Yii;
use backend\models\CompanyDetails;
use app\models\CompanyDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyDetailsController implements the CRUD actions for CompanyDetails model.
 */
class CompanyDetailsController extends Controller
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
     * Lists all CompanyDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyDetailsSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single CompanyDetails model.
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
     * Creates a new CompanyDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyDetails;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $logopath = Yii::$app->controller->module->basePath.'/assets/uploads/logo';
            $bannerpath = Yii::$app->controller->module->basePath.'/assets/uploads/banner';
            
            $logo = \yii\web\UploadedFile::getInstance($model, 'logo_pic');
            $banner = \yii\web\UploadedFile::getInstance($model, 'wallpaper_pic');
            
            $logo->name = $model->company_id.'logo'.$logo->extension;
            $banner->name = $model->company_id.'banner'.$banner->extention;
            
            $logo->saveAs($logopath.$logo->name);
            $banner->saveAs($bannerpath.$banner->name);
            
            $model->logo_pic = $logo->name;
            $model->wallpaper_pic = $banner->name;
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else 
            {
            return $this->render('create', [
                'model' => $model,
            ]);
            }
    }

    /**
     * Updates an existing CompanyDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $company_id = Yii::$app->user->identity->company_id;
        $model = CompanyDetails::find(['company_id' => $company_id])->all();
        if($model)
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else 
        {
            return $this->redirect(['create']);
        }
    }

    /**
     * Deletes an existing CompanyDetails model.
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
     * Finds the CompanyDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
