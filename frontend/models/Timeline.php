<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mup_timeline".
 *
 * @property integer $id
 * @property string $company_id
 * @property string $action_type
 * @property string $action_id
 * @property string $date_added
 * @property string $complaint_id
 */
class Timeline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_timeline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'action_type', 'action_id', 'date_added'], 'required'],
            [['date_added'], 'safe'],
            [['company_id', 'action_id', 'complaint_id'], 'string', 'max' => 12],
            [['action_type'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'action_type' => 'Action Type',
            'action_id' => 'Action ID',
            'date_added' => 'Date Added',
            'complaint_id' => 'Complaint ID',
        ];
    }
}