<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use frontend\components\Voh;
/**
 * This is the model class for table "mup_reply".
 *
 * @property integer $id
 * @property string $complaint_id
 * @property string $message
 * @property string $date_addded
 * @property string $date_updated
 * @property string $company_id
 * @property string $user_id
 * @property string $type
 * @property string $level
 *
 * @property MupCompany $company
 * @property MupComplaint $complaint
 */
class Escalate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_id', 'message', 'date_addded', 'date_updated', 'company_id', 'user_id'], 'required'],
            [['message'], 'string'],
            [['date_addded', 'date_updated'], 'safe'],
            [['complaint_id', 'company_id', 'user_id'], 'string', 'max' => 12],
            [['type'], 'string', 'max' => 1],
            [['level'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'complaint_id' => 'Complaint ID',
            'message' => 'Message',
            'date_addded' => 'Date Addded',
            'date_updated' => 'Date Updated',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(MupCompany::className(), ['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaint()
    {
        return $this->hasOne(MupComplaint::className(), ['complaint_id' => 'complaint_id']);
    }
    
    public function beforeValidate() {
        if ($this->isNewRecord)
        {
            $this->date_addded = new Expression('Now()');
            $this->user_id = (Yii::$app->user->isGuest)?Voh::guest_id:Yii::$app->user->id;
        }
        $this->date_updated = new Expression('Now()');
        return parent::beforeValidate();
    }
}
