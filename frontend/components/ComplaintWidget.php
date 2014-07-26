<?php

/* 
 * A widget for the complaint form
 */

namespace frontend\components;

use app\models\Complaint;

class ComplaintWidget extends \yii\base\Widget
{
    public $mode;
    public $title;
    
    public function init()
    {
        parent::init();
        if ($this->mode === null){
            $this->mode = 'simple';
        }
        if ($this->title === null)
        {
            $this->title = 'New Complaint';
        }
    }
    
    public function run()
    {
        $model = new Complaint();
        echo $this->render('complaintform',['model'=>$model,'title'=>$this->title]);
    }
    
    
}