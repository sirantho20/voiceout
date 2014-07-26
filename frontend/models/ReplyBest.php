<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mup_reply_best".
 *
 * @property integer $id
 * @property string $complaint_id
 * @property integer $reply_id
 * @property string $date_added
 */
class ReplyBest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_reply_best';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'complaint_id', 'reply_id', 'date_added'], 'required'],
            [['id', 'reply_id'], 'integer'],
            [['date_added'], 'safe'],
            [['complaint_id'], 'string', 'max' => 12],
            [['complaint_id'], 'unique']
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
            'reply_id' => 'Reply ID',
            'date_added' => 'Date Added',
        ];
    }
}
