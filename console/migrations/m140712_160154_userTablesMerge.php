<?php

use yii\db\Schema;
use yii\db\Migration;

class m140712_160154_userTablesMerge extends Migration
{
    public function safeUp()
    {
        //$this->dropForeignKey('fk_user_comment', 'mup_comment');
        //$this->dropForeignKey('fk_complaints_user', 'mup_complaint');
        //$this->dropTable('mup_user');
        //$this->dropForeignKey('fk_mup_company_users_company', 'mup_company_users');
        //$this->dropTable('mup_company_users');
//        $this->renameTable('user', 'mup_user');
//        $this->renameTable('profile', 'mup_user_profile');
//        $this->renameTable('account', 'mup_user_account');
        //$this->addColumn('user', 'user_id', Schema::TYPE_STRING);
    }

    public function safeDown()
    {
        //$this->dropColumn('user', 'user_id');
    }
}
