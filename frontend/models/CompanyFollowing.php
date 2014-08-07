<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mup_company_following".
 *
 * @property integer $id
 * @property string $company_id
 * @property string $user_id
 * @property string $date_added
 */
class CompanyFollowing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_company_following';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'date_added'], 'required'],
            [['date_added'], 'safe'],
            [['company_id', 'user_id'], 'string', 'max' => 45]
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
            'user_id' => 'User ID',
            'date_added' => 'Date Added',
        ];
    }
}
