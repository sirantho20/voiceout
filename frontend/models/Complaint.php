<?php

namespace app\models;

use Yii;
use frontend\components\Voh;
use yii\db\Expression;

/**
 * This is the model class for table "mup_complaint".
 *
 * @property integer $id
 * @property string $complaint_id
 * @property string $company_id
 * @property string $user_id
 * @property string $cookie_id
 * @property string $complaint
 * @property string $hashtag
 * @property string $is_private
 * @property integer $rating
 * @property string $date_added
 * @property string $date_updated
 * @property string $published
 * @property string $has_picture
 * @property string $has_audio
 * @property string $location
 * @property string $slug
 *
 * @property MupAudio[] $mupAudios
 * @property MupComment[] $mupComments
 * @property MupCompany $company
 * @property MupUser $user
 * @property MupComplaintHashtags[] $mupComplaintHashtags
 * @property MupPictures[] $mupPictures
 * @property MupReply[] $mupReplies
 */
class Complaint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mup_complaint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_id', 'company_id', 'user_id', 'complaint', 'date_added', 'date_updated', 'slug'], 'required'],
            [['rating'], 'integer'],
            [['date_added', 'date_updated'], 'safe'],
            [['complaint_id', 'company_id', 'user_id'], 'string', 'max' => 12],
            [['cookie_id'], 'string', 'max' => 45],
            [['complaint', 'hashtag', 'slug'], 'string', 'max' => 255],
            [['is_private', 'published', 'has_picture', 'has_audio'], 'string', 'max' => 1],
            [['location'], 'string', 'max' => 100],
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
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'cookie_id' => 'Cookie ID',
            'complaint' => 'Complaint',
            'hashtag' => 'Hashtag',
            'is_private' => 'Is Private',
            'rating' => 'Rating',
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
            'published' => 'Published',
            'has_picture' => 'Has Picture',
            'has_audio' => 'Has Audio',
            'location' => 'Location',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupAudios()
    {
        return $this->hasMany(MupAudio::className(), ['complaint_id' => 'complaint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupComments()
    {
        return $this->hasMany(MupComment::className(), ['complaint_id' => 'complaint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(MupCompany::className(), ['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(MupUser::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupComplaintHashtags()
    {
        return $this->hasMany(MupComplaintHashtags::className(), ['complaint_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupPictures()
    {
        return $this->hasMany(MupPictures::className(), ['complaint_id' => 'complaint_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMupReplies()
    {
        return $this->hasMany(MupReply::className(), ['complaint_id' => 'complaint_id']);
    }
    
    /*
     * @ prevalidation assignments
     */
    public function beforeValidate()
    {
        $voh = new Voh;
        if ($this->isNewRecord)
        {
            $this->complaint_id = $voh->newComplaintId();
            $this->date_added = new Expression('Now()');
            $this->user_id = (Yii::$app->user->isGuest)?Voh::guest_id:Yii::$app->user->id;
        }
        $this->date_updated = new Expression('Now()');
        return parent::beforeValidate();
    }
    
    /*
    * Behaviors for this model
    */
    public function behaviors(){
      return array(
        'sluggable' => array(
          'class'=>'frontend\extensions\SluggableBehavior',
          'columns' => array('company_id', 'complaint'),
          'unique' => true,
          'update' => true,
        ),
      );
    }
    
}   
