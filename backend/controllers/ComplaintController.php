<?php

namespace backend\controllers;

use Yii;
use backend\models\Complaint;
use backend\models\ComplaintSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComplaintController implements the CRUD actions for Complaint model.
 */
class ComplaintController extends Controller
{
    public $layout = '/adminMain';
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
     * Lists all Complaint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComplaintSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRead($id)
    {
        $complaint = Complaint::findOne(['complaint_id'=>$id]);
        
        $comp = \backend\models\Company::findOne(['company_id' =>$complaint->company_id]);
        return $this->renderPartial('read',[
                'complaint' => $complaint,
                'username' => $this->loadUser($complaint->user_id),
                'company' => $comp
                ]);
    }


    public function actionList()
    {
        
        $output = '<table id="inbox-table" class="table table-striped table-hover"><tbody>';
        
        $data = Complaint::findAll(['company_id'=>  Yii::$app->user->identity->company_id]);
        $dat = [
            [
                'user_id' =>3,
                'complaint'=>'what is the meaning of all this bad service you are providing??',
                'date_added'=>'2014-08-05 17:24:56',
                'complaint_id' => 30
            ],
            [
                'user_id' =>2,
                'complaint'=>'what is the meaning of all this bad service you are providing??',
                'date_added'=>'2014-08-01 17:24:56',
                'complaint_id' => 45
            ]
        ];
        foreach($data as $row)
        {
            //print_r($row['user_id']);die();
            $output .= '<tr id="msg1" class="unread">
			<td class="inbox-table-icon">
				<div class="checkbox">
					<label>
						<input type="checkbox" class="checkbox style-2">
						<span></span> 
                                        </label>
				</div>
			</td>'.
                        // message from
                        '<td class="inbox-data-from hidden-xs hidden-sm" id="'.$row['complaint_id'].'">
                                    <div>
                                            '.$this->loadUser($row['user_id']).'
                                    </div>
                        </td>'.
                        // message excerpt 
                        '<td class="inbox-data-message" id="'.$row['complaint_id'].'">
				<div>
					'.implode(' ', array_slice(explode(' ', $row['complaint']), 0, 8)).'
				</div>
			</td>'.
                        // message attachments
                        '<td class="inbox-data-attachment hidden-xs">
				<div>
					<a href="javascript:void(0);" rel="tooltip" data-placement="left" data-original-title="FILES: rocketlaunch.jpg, timelogs.xsl" class="txt-color-darken"><i class="fa fa-paperclip fa-lg"></i></a>
				</div>
			</td>'.
                        // message datetime
                        '<td class="inbox-data-date hidden-xs">
				<div>
					'.(new \yii\base\Formatter())->asDate($row['date_added'],'g:i a').'
				</div>
			</td>'.
                        // row end
                        '</tr>';
        }
        
        $output .= '</tbody></table>';
        return $this->renderPartial('list',['output'=>$output]);
        
    }
    
    public function loadUser($id)
    {
        if(($user = \backend\models\User::findOne($id)) !== NULL)
        {
            return $user->username;
        }
        else {
            return false;
        }
        
    }
    
        public static function getUsername($id)
    {
        if(($user = \backend\models\User::findOne($id)) !== NULL)
        {
            return $user->username;
        }
        else {
            return false;
        }
        
    }
        /**


    /**
     * Displays a single Complaint model.
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
     * Creates a new Complaint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Complaint();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Complaint model.
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
     * Deletes an existing Complaint model.
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
     * Finds the Complaint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Complaint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Complaint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
