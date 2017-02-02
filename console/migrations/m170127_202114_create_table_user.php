<?php

use yii\db\Migration;

class m170127_202114_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'email' => $this->string(55),
            'password' => $this->string(70),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
