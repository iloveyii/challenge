<?php

use yii\db\Migration;

class m170129_115435_create_table_customer extends Migration
{
    public function up()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'name' => $this->string(65)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('customer');
    }
}
