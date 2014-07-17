<?php

/* 
 * Voice out helper class
 */
namespace frontend\components;

use app\models\Complaint;

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
        while (Complaint::find('complaint_id=:id',array(':id'=>$id))->exists());
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
        while (Company::find('company_id=:id',array(':id'=>$id))->exists());
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
        while (User::find('user_id=:id',array(':id'=>$id))->exists());
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
        $ret = preg_replace("/#(\w+)/", "<a href=\"http://voiceout/complaint/tag?q=\\1\" target=\"_self\">#\\1</a>", $ret);
        return $ret;
    }
    

}
