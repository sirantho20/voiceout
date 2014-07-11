<?php

use yii\db\Schema;
use yii\db\Migration;

class m140711_143742_addUserCompanyFK extends Migration
{
     public function up()
    {
//        $this->createIndex('user_company_idx', 'user', 'company_id');
//        $this->addForeignKey('user_company', 'user', 'company_id', 'mup_company', 'company_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
//        $this->dropIndex('user_company_idx', 'user');
//        $this->dropForeignKey('user_company', 'user');
    }
}
