<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "mup_company".
 *
 * @property integer $id
 * @property string $company_id
 * @property string $company_name
 * @property string $date_added
 * @property string $date_updated
 * @property string $confirmed
 * @property integer $industry_id
 * @property integer $category_id
 * @property string $slug
 * @property string $is_registered
 * @property integer $license_package
 *
 * @property MupLicensePacakges $licensePackage
 * @property MupCategory $category
 * @property MupIndustry $industry
 * @property MupCompanyDetails[] $mupCompanyDetails
 * @property MupCompanyUsers[] $mupCompanyUsers
 * @property MupComplaint[] $mupComplaints
 * @property MupReply[] $mupReplies
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'company_name', 'date_added', 'date_updated', 'slug'], 'required'],
            [['date_added', 'date_updated'], 'safe'],
            [['industry_id', 'category_id', 'license_package'], 'integer'],
            [['company_id'], 'string', 'max' => 12],
            [['company_name'], 'string', 'max' => 100],
            [['confirmed', 'is_registered'], 'string', 'max' => 1],
            [['slug'], 'string', 'max' => 255],
            [['company_id'], 'unique'],
            [['company_name'], 'unique']
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
            'company_name' => 'Company Name',
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
            'confirmed' => 'Confirmed',
            'industry_id' => 'Industry ID',
            'category_id' => 'Category ID',
            'slug' => 'Slug',
            'is_registered' => 'Is Registered',
            'license_package' => 'License Package',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicensePackage()
    {
        return $this->hasOne(MupLicensePacakges::className(), ['id' => 'license_package']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MupCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustry()
    {
        return $this->hasOne(MupIndustry::className(), ['id' => 'industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupCompanyDetails()
    {
        return $this->hasMany(MupCompanyDetails::className(), ['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupCompanyUsers()
    {
        return $this->hasMany(MupCompanyUsers::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupComplaints()
    {
        return $this->hasMany(MupComplaint::className(), ['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupReplies()
    {
        return $this->hasMany(MupReply::className(), ['company_id' => 'company_id']);
    }
    
    public function beforeValidate() {
        $date = new Expression('NOW()');
        if($this->isNewRecord)
        {
        $this->date_added = $date;
        $this->date_updated = $date;
        }
        else 
        {
            $this->date_updated = $date;
        }
        
        return parent::beforeValidate();
    }
}
