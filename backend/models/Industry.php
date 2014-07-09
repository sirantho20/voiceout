<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mup_industry".
 *
 * @property integer $id
 * @property string $industry_name
 * @property string $date_added
 * @property string $date_updated
 *
 * @property MupCompany[] $mupCompanies
 */
class Industry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_industry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['industry_name', 'date_added', 'date_updated'], 'required'],
            [['date_added', 'date_updated'], 'safe'],
            [['industry_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'industry_name' => 'Industry Name',
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupCompanies()
    {
        return $this->hasMany(MupCompany::className(), ['industry_id' => 'id']);
    }
}
