<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mup_timeline".
 *
 * @property integer $id
 * @property string $company_id
 * @property string $action_type
 * @property string $date_added
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
            [['id', 'company_id', 'action_type', 'date_added'], 'required'],
            [['id'], 'integer'],
            [['date_added'], 'safe'],
            [['company_id'], 'string', 'max' => 12],
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
            'date_added' => 'Date Added',
        ];
    }
}
