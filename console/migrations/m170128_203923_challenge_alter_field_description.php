<?php

use yii\db\Migration;

class m170128_203923_challenge_alter_field_description extends Migration
{
    public function up()
    {
        $this->alterColumn('challenge', 'description', $this->string(200) );
    }

    public function down()
    {
        $this->alterColumn('challenge', 'description', $this->timestamp() );
    }
}
