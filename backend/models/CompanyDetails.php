<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mup_company_details".
 *
 * @property integer $id
 * @property string $company_id
 * @property string $email_address
 * @property string $phone_number
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property integer $country_id
 * @property string $logo_pic
 * @property string $wallpaper_pic
 *
 * @property MupCountry $country
 * @property MupCompany $company
 */
class CompanyDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_company_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['country_id'], 'integer'],
            [['company_id'], 'string', 'max' => 12],
            [['email_address', 'address_line_1', 'address_line_2'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 20],
            [['city'], 'string', 'max' => 100],
            [['logo_pic', 'wallpaper_pic'], 'string', 'max' => 45],
            [['company_id'], 'unique']
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
            'email_address' => 'Email Address',
            'phone_number' => 'Phone Number',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'city' => 'City',
            'country_id' => 'Country ID',
            'logo_pic' => 'Logo Pic',
            'wallpaper_pic' => 'Wallpaper Pic',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(MupCountry::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(MupCompany::className(), ['company_id' => 'company_id']);
    }
    
    public function beforeValidate() {
        $this->company_id = Yii::$app->user->identity->company_id;
        parent::beforeValidate();
    }
}
