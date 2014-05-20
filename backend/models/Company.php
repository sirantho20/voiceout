<?php

namespace app\models;

use Yii;

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
 *
 * @property MupCategory $category
 * @property MupIndustry $industry
 * @property MupCompanyDetails[] $mupCompanyDetails
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
            [['industry_id', 'category_id'], 'integer'],
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
        ];
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
}
