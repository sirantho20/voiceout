<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mup_pictures".
 *
 * @property integer $id
 * @property string $complaint_id
 * @property string $link
 *
 * @property MupComplaint $complaint
 */
class Pictures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_pictures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_id', 'link'], 'required'],
            [['complaint_id'], 'string', 'max' => 12],
            [['link'], 'string', 'max' => 100]
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
            'link' => 'Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaint()
    {
        return $this->hasOne(MupComplaint::className(), ['complaint_id' => 'complaint_id']);
    }
    
    /*
     *  @return piture link given id.
     */
    public static function getPictureLink($id=null)
    {
        if (!is_null($id))
        {
             $model = self::find()->where(['complaint_id'=>$id])->one();
             return $model->link;
        }
    }
}
