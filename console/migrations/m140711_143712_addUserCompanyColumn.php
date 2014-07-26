<?php

use yii\db\Schema;
use yii\db\Migration;

class m140711_143712_addUserCompanyColumn extends Migration
{
   public function up()
    {
        $this->addColumn('user', 'company_id', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('user', 'company_id');
    }
}
