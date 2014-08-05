<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use frontend\components\Voh;

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
 * @property string $description
 *
 * @property MupCategory $category
 * @property MupIndustry $industry
 * @property MupLicensePacakges $licensePackage
 * @property MupCompanyDetails[] $mupCompanyDetails
 * @property MupCompanyUsers[] $mupCompanyUsers
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
            [['company_id', 'company_name', 'date_added', 'date_updated', 'slug', 'description'], 'required'],
            [['date_added', 'date_updated'], 'safe'],
            [['industry_id', 'category_id', 'license_package'], 'integer'],
            [['company_id'], 'string', 'max' => 12],
            [['company_name'], 'string', 'max' => 100],
            [['confirmed', 'is_registered'], 'string', 'max' => 1],
            [['slug'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 140],
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
            'description' => 'Description',
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
    public function getLicensePackage()
    {
        return $this->hasOne(MupLicensePacakges::className(), ['id' => 'license_package']);
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
    
    /*
     *  @return company name give id. if no id, return an array of all
     */
    public static function getCompanyName($id=null)
    {
        if (is_null($id))
        {
            $model = self::find()->asArray()->all();
            return ArrayHelper::map($model,'company_id','company_name');
        }
        else 
        {
            $model = self::find()->where(['company_id'=>$id])->one();
            return $model->company_name;
        } 
    }
    
     /*
     *  @return company slug give id. if no id, return an array of all
     */
    public static function getCompanySlug($id)
    {
        $id = (int)$id;
        $model = self::find()->where(['company_id'=>$id])->one();
        return $model->slug;
    }
    
    /*
    * Behaviors for this model
    */
    public function behaviors()
    {
    return [
        'slug' => [
            'class' => 'Zelenin\yii\behaviors\Slug',
            'source_attribute' => ['company_id','company_name'],
            'slug_attribute' => 'slug',

            // optional params
            'translit' => true,
            'replacement' => '-',
            'lowercase' => true,
            'unique' => true
        ]
    ];
    }
    
    public function beforeValidate() {
        $voh = new Voh;
        if ($this->isNewRecord)
        {
            $this->company_id = $voh->newCompanyId();
            $this->date_added = new Expression('Now()');
        }
        $this->date_updated = new Expression('Now()');
        
        return parent::beforeValidate();
    }
    
}
