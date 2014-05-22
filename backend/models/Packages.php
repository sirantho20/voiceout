<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mup_license_pacakges".
 *
 * @property integer $id
 * @property string $package_name
 * @property integer $number_of_users
 * @property string $signup_date
 * @property string $renewal_date
 *
 * @property MupCompany[] $mupCompanies
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_license_pacakges';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'package_name'], 'required'],
            [['id', 'number_of_users'], 'integer'],
            [['signup_date', 'renewal_date'], 'safe'],
            [['package_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'package_name' => 'Package Name',
            'number_of_users' => 'Number Of Users',
            'signup_date' => 'Signup Date',
            'renewal_date' => 'Renewal Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupCompanies()
    {
        return $this->hasMany(MupCompany::className(), ['license_package' => 'id']);
    }
}
