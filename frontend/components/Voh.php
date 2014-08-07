<?php

/* 
 * Voice out helper class
 */
namespace frontend\components;

use app\models\Complaint;
use app\models\Company;
use app\models\User;
use Yii;

class Voh 
{
    CONST allowed_chars = '123456789';
    CONST char_length  = 12;
    CONST guest_id = '1000010000';
    /*
     * Function for generating random integer for various ids
     */
    protected function randomInteger($length){
        if (isset ($length) & $length != '')
        {
            $length = (int)$length;
        }
        else {
            $length = sel::char_length;
        }
        $allowed = self::allowed_chars;
        $generated = '';
        for($i=0; $i<$length; $i++)
        {
            $generated .= $allowed[mt_rand(0,strlen(self::allowed_chars)-1)];
        }
        return $generated;
    }
    
    /*
     * Complaint Id Generator
     */
    public function newComplaintId()
    {
        $id = '';
        do {
            $id = $this->randomInteger(10);
        }
        while (Complaint::find()->where(['complaint_id'=>$id])->exists());
        return $id;
    }
    /*
     * Company Id Generator
     */
    public function newCompanyId()
    {
        $id = '';
        do {
            $id = $this->randomInteger(12);
        }
        while (Company::find()->where(['company_id'=>$id])->exists());
        return $id;
    }
    
    /*
     * User Id Generator
     */
    public function newUserId()
    {
        $id = '';
        do {
            $id = $this->randomInteger(10);
        }
        while (User::find()->where(['user_id'=>$id])->exists());
        return $id;
    }
    
    /*
     * Detect hashtags in complaints
     */
    public function hashTag($complaint)
    {
        $string = strip_tags(htmlentities($complaint));
        preg_match_all("/#(\\w+)/", $string, $matches);
        $hashes = $matches[1];
        if (is_array($matches[1]))
        {
            $hashes = implode(', ',$matches[1]);
        }
        else { $hashes = ''; }
        return $hashes;
    }
    
    /*
     * Function for adding clickable link to all tags in complaints
     */
    public function linkTag($ret) {
        //$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2", $ret);
        //$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2", $ret);
        //$ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
        $ret = preg_replace("/#(\w+)/", "<a href=\"http://voiceout/frontend/index.php/complaint/tag?q=\\1\" target=\"_self\">#\\1</a>", $ret);
        return $ret;
    }
    
    public static function truncateByWord($string, $maxCharLength = 100, $append = '...')
    {
    $string = strip_tags($string);
    $words = preg_split('/\s+/', $string);

    $reformed_string = '';
    for($i = 0, $size = sizeof($words); $i < $size; $i++){
        if(strlen($reformed_string.' '.$words[$i]) > $maxCharLength){
            if($append){
                $reformed_string .= $append;
            }
            break;
        }else{
            if($i > 0){
                $reformed_string .= (' '.$words[$i]);
            }else{
                $reformed_string .= $words[$i];
            }
        }
    }
    return $reformed_string;
    }
    
    public static function ComplaintTimeline($complaint_id){
        if (isset($complaint_id) && $complaint_id != ''){
            if (\app\models\Timeline::find()->where(['complaint_id'=>$complaint_id])->exists())
            {
                $timeline = \app\models\Timeline::find()->where(['complaint_id'=>$complaint_id])->all();
                echo Yii::$app->view->renderFile('@app/components/views/complainttimeline.php',['timeline'=>$timeline]);       
            }
            else
            {
                return "<h3>No replies yet. Be the first to reply!</h3>";
            }            
        }
    }
    
    public static function EscalateCounter($complaint_id)
    {
        if (trim($complaint_id) != '')
        {
            $count = \app\models\Escalate::find()->where(['complaint_id'=>$complaint_id,'type'=>'E'])->count();
            return $count;
        }
    }
    public static function EscalateUserCounter($complaint_id,$user_id)
    {
        if (trim($complaint_id)!='' && trim($user_id)!='')
        {
            if(\app\models\Escalate::find()->where(['complaint_id'=>$complaint_id,'user_id'=>$user_id,'type'=>'E'])->exists())
            {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    public static function ReplyCounter($complaint_id)
    {
        if (trim($complaint_id) != '')
        {
            $count = \app\models\Reply::find()->where(['complaint_id'=>$complaint_id,'type'=>'R'])->count();
            return $count;
        }
    }
    public static function FollowCounter($complaint_id)
    {
        if (trim($complaint_id) != '')
        {
            $count = \app\models\ComplaintFollowing::find()->where(['complaint_id'=>$complaint_id])->count();
            return $count;
        }
    }
    public static function FollowUserCounter($complaint_id,$user_id)
    {
        if (trim($complaint_id)!='' && trim($user_id)!='')
        {
            if(\app\models\ComplaintFollowing::find()->where(['complaint_id'=>$complaint_id,'user_id'=>$user_id])->exists())
            {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public static function FollowCompanyUser($company_id,$user_id)
    {
        if (trim($company_id)!='' && trim($user_id)!='')
        {
            if(\app\models\CompanyFollowing::find()->where(['company_id'=>$company_id,'user_id'=>$user_id])->exists())
            {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public static function FollowCompanyCounter($company_id)
    {
        if (trim($company_id) != '')
        {
            $count = \app\models\CompanyFollowing::find()->where(['company_id'=>$company_id])->count();
            return $count;
        }
    }
    
    public function CompanyTimeline(){
        
    }
    
}
