<?php

use yii\db\Schema;

class m140707_170958_dbSetup extends \yii\db\Migration
{
    public function up()
    {
        $this->execute(file_get_contents(\Yii::getAlias('@common').'/data/voiceout.sql'));
    }

    public function down()
    {
    }
}
